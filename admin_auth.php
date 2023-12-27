<?php
require_once(__DIR__ . '/server/db.php');
$un = $_POST['username'];
$pw = $_POST['password'];

$username = mysqli_real_escape_string($conn, $un);
$password = mysqli_real_escape_string($conn, $pw);

$checkUsernameQuery = "SELECT * FROM admins WHERE username = '$username'";
$checkUsernameResult = $conn->query($checkUsernameQuery);

if ($checkUsernameResult->num_rows == 0) {
    http_response_code(400);
    echo json_encode(array("message" => "Invalid username or password"));
} else {
    $row = $checkUsernameResult->fetch_row();

    if ($password == $row[2]) {
        session_start();
        $_SESSION["admin_token"] = bin2hex(32);

        http_response_code(201);
        echo json_encode("Login success");
        echo "<br><a href='panel.php'>Click here to go to Admin Panel</a>";
        exit();
    } else {
        echo json_encode(array("message" => "Invalid username or password"));
    }


}




?>