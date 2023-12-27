<?php
require_once(__DIR__ . '/server/db.php');

$id = $_POST["id"];
$username = $_POST["username"];
$email = $_POST["email"];
$bio = $_POST["bio"];
$password = $_POST["password"];

$user_id = mysqli_escape_string($conn, $id);
$un = mysqli_escape_string($conn, $username);
$em = mysqli_escape_string($conn, $email);
$b = mysqli_escape_string($conn, $bio);
$pw = mysqli_escape_string($conn, $password);



if ($pw == ""){
    $checkUpdateQuery = "UPDATE users SET username='$un', email='$em', bio='$b' WHERE user_id=$user_id";
    $checkUpdateResult = $conn->query($checkUpdateQuery);
} else {
    $hashed_password = password_hash($pw, PASSWORD_DEFAULT);
    $checkUpdateQuery = "UPDATE users SET username='$un', email='$em', bio='$b', password='$hashed_password' WHERE user_id=$user_id";
    $checkUpdateResult = $conn->query($checkUpdateQuery);

}

// $checkUpdateQuery = "UPDATE users SET username='$un', email='$em', bio='$b' password='' WHERE user_id=$user_id";



echo "Update Success";

?>