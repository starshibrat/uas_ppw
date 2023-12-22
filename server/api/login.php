<?php
require_once(__DIR__ . '/../db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $un = $_POST['username'];
    $pw = $_POST['password'];

    $username = mysqli_real_escape_string($conn, $un);
    $password = mysqli_real_escape_string($conn, $pw);

    $checkUsernameQuery = "SELECT * FROM users WHERE username = '$username'";
    $checkUsernameResult = $conn->query($checkUsernameQuery);

    if ($checkUsernameResult->num_rows == 0) {
        http_response_code(400);
        echo json_encode(array("message" => "Invalid username or password"));
    } else {
        $row = $checkUsernameResult->fetch_row();

        if (password_verify($password, $row[2])) {
            http_response_code(201);
            echo json_encode(array("message" => "Login success"));
        } else {
            echo json_encode(array("message" => "Invalid username or password"));
        }
    }
} else {
    http_response_code(405);
    echo json_encode(array("message" => "Method Not Allowed"));
}
?>