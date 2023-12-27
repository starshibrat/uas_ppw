<?php
ob_start();
require_once(__DIR__ . '/../db.php');
require_once(__DIR__ . '/../../models/user_model.php');

$cur_dir = __DIR__;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $un = $_POST['username'];
    $pw = $_POST['password'];

    $correct_answer = $_POST["correct_answer"];
    $answer = $_POST["answer"];

    if ($correct_answer != $answer) {
        echo "Wrong Captcha";
        echo "<br><a href='../../index.php'>Click here to go to try again</a>";
        exit();

    }

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
            echo json_encode("Login success");

            $user = new User($username, $row[0]);

            session_start();
            $_SESSION["current_user"] = $user;
            $_SESSION["token"] = bin2hex(32);


            echo "<br><a href='../../dashboard.php'>Click here to go to dashboard</a>";
            exit();
        } else {
            echo json_encode(array("message" => "Invalid username or password"));
        }
    }
} else {
    http_response_code(405);
    echo json_encode(array("message" => "Method Not Allowed"));
}

ob_end_flush();
?>