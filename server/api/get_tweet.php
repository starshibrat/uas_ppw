<?php

require_once(__DIR__ . '/../db.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $pi = $_GET['post_id'];
    
    $post_id = mysqli_escape_string($conn, $pi);

    $checkPostQuery = "SELECT * FROM posts WHERE post_id=$post_id";
    

    $checkPostResult = $conn->query($checkPostQuery);

    if ($checkPostResult->num_rows == 0){

        http_response_code(400);
        echo json_encode(array("message" => "The post doesn't exist"));


    } else {
        $row = $checkPostResult->fetch_row();
        $checkReactionQuery = "SELECT * FROM post_reactions WHERE post_id=$post_id AND love=1";
        $checkReactionResult = $conn->query($checkReactionQuery);
        $number_of_loves = mysqli_num_rows($checkReactionResult);
        $post = [
            "post_id" => $row[0],
            "user_id" => $row[1],
            "content" => $row[2],
            "post_date" => $row[3],
            "loves" => $number_of_loves

        ];

        http_response_code(200);
        echo json_encode($post);

    }

} else {
    http_response_code(405);
    echo json_encode(array("message" => "Method Not Allowed"));
}

?>