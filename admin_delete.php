<?php
require_once(__DIR__ . '/server/db.php');

$id = $_POST["user_id"];
$user_id = mysqli_escape_string($conn, $id);

$checkUpdateQuery = "DELETE FROM users WHERE user_id=$user_id";
$checkUpdateResult = $conn->query($checkUpdateQuery);

echo "Delete success";

?>