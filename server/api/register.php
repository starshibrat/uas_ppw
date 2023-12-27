<?php
require_once(__DIR__.'/../db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $un = $_POST['username'];
    $pw = $_POST['password'];
    $em = $_POST['email'];


    $username = mysqli_real_escape_string($conn, $un);
    $email = mysqli_real_escape_string($conn, $em);
    $password = mysqli_real_escape_string($conn, $pw);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $checkUsernameQuery = "SELECT * FROM users WHERE username = '$username'";
    $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkUsernameResult = $conn->query($checkUsernameQuery);
    $checkEmailResult = $conn->query($checkEmailQuery);

    echo '<a href="../../index.php">Click Here to Login</a>';

    if ($checkUsernameResult->num_rows > 0){
        http_response_code(400);
        echo json_encode(array("message" => "Username already exists"));
    }  elseif ($checkEmailResult->num_rows > 0){
        http_response_code(400);
        echo json_encode(array("message" => "Email already exists"));
    } else {
        $insertQuery = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        
        if ($conn->query($insertQuery) === TRUE){
            http_response_code(201);
            
            echo json_encode(array("message" => "User registered successfully"));
        } else {
            http_response_code(500);
            echo json_encode(array("message" => "Failed to register user"));
        }

    }

} else {
    http_response_code(405);
    echo json_encode(array("message" => "Method Not Allowed"));
}


?>