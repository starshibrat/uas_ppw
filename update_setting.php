<?php
require_once(__DIR__ . '/server/db.php');

$id = $_POST["id"];
$username = $_POST["username"];
$email = $_POST["email"];
$bio = $_POST["bio"];

$user_id = mysqli_escape_string($conn, $id);
$un = mysqli_escape_string($conn, $username);
$em = mysqli_escape_string($conn, $email);
$b = mysqli_escape_string($conn, $bio);

$checkUpdateQuery = "UPDATE users SET username='$un', email='$em', bio='$b' WHERE user_id=$user_id";

$checkUpdateResult = $conn->query($checkUpdateQuery);

echo "Update Success";
echo "<a href='dashboard.php'>Back to Dashboard</a>";

?>