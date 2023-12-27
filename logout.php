<?php 
session_start();
unset($_SESSION["token"]);
echo "Logout success";
header("Location: dashboard.php");

?>