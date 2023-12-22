<?php
require_once(__DIR__ . '/../db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $post_text = $_POST['post_text'];

    $id = mysqli_escape_string($conn, $user_id);
    $content = mysqli_real_escape_string($conn, $post_text);

    $insertQuery = "INSERT INTO posts (user_id, post_text) VALUES ($id, '$content')";

    if ($conn->query($insertQuery) === TRUE){
        http_response_code(201);
        echo json_encode(array("message" => "Post created successfully"));
    } else {
        http_response_code(500);
        echo json_encode(array("message" => "Failed to post"));
    }


} else {
    http_response_code(405);
    echo json_encode(array("message" => "Method Not Allowed"));
}


?>