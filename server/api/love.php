<?php
require_once(__DIR__ . '/../db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $us_id = $_POST['user_id'];
    $ps_id = $_POST['post_id'];

    $user_id = mysqli_escape_string($conn, $us_id);
    $post_id = mysqli_escape_string($conn, $ps_id);

    $checkReactionQuery = "SELECT * FROM post_reactions WHERE user_id=$user_id AND post_id=$post_id";

    $checkReactionResult = $conn->query($checkReactionQuery);

    if ($checkReactionResult->num_rows == 0) {
        $insertQuery = "INSERT INTO post_reactions (user_id, post_id, love) VALUES($user_id, $post_id, 1)";

        if ($conn->query($insertQuery) === TRUE) {
            http_response_code(201);
            echo "<br><a href='../../dashboard.php'>Click here to go to dashboard</a>";
            echo json_encode(array("message" => "Post reacted successfully"));
        } else {
            http_response_code(500);
            echo json_encode(array("message" => "Failed to react"));
        }

    } else {
        $row = $checkReactionResult->fetch_row();
        if ($row[3] == 0) {
            $love = 1;
        } else {
            $love = 0;
        }

        $updateQuery = "UPDATE post_reactions SET love=$love WHERE user_id=$user_id AND post_id=$post_id";

        if ($conn->query($updateQuery) === TRUE) {
            http_response_code(201);
            echo "<br><a href='../../dashboard.php'>Click here to go to dashboard</a>";
            echo json_encode(array("message" => "Post reacted successfully"));
        } else {
            http_response_code(500);
            echo json_encode(array("message" => "Failed to react"));
        }

    }


} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $us_id = $_GET['user_id'];
    $ps_id = $_GET['post_id'];
    $user_id = mysqli_escape_string($conn, $us_id);
    $post_id = mysqli_escape_string($conn, $ps_id);

    $checkReactionQuery = "SELECT * FROM post_reactions WHERE user_id=$user_id AND post_id=$post_id";

    $checkReactionResult = $conn->query($checkReactionQuery);

    if ($checkReactionResult->num_rows == 0) {

        echo 0;

    } else {

        $row = $checkReactionResult->fetch_row();
        if ($row[3] == 0) {
            echo 0;
        } else {
            echo 1;
        }


    }

} else {
    http_response_code(405);
    echo json_encode(array("message" => "Method Not Allowed"));
}
?>