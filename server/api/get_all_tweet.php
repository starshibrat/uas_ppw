<?php

require_once(__DIR__ . '/../db.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $checkPostQuery = "SELECT * FROM posts";
    $checkPostResult = $conn->query($checkPostQuery);
    
    echo mysqli_num_rows($checkPostResult);


}

?>