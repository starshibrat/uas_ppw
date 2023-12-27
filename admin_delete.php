<?php
require_once(__DIR__ . '/server/db.php');

$id = $_POST["user_id"];
$user_id = mysqli_escape_string($conn, $id);

$checkUpdateQuery = "DELETE FROM users WHERE user_id=$user_id";
$checkPostQuery = "DELETE FROM posts WHERE user_id=$user_id";
$checkFollowerQuery = "DELETE FROM follows WHERE follower_id=$user_id";
$checkFollowingQuery = "DELETE FROM follows WHERE following_id=$user_id";
$checkReactionQuery = "DELETE FROM post_reactions WHERE user_id=$user_id";

$checkUpdateResult = $conn->query($checkPostQuery);
$checkUpdateResult = $conn->query($checkFollowerQuery);
$checkUpdateResult = $conn->query($checkFollowingQuery);
$checkUpdateResult = $conn->query($checkUpdateQuery);

echo '<a href="panel.php">Back to Admin Panel</a>';


echo "Delete success";

?>