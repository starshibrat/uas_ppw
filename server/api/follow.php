<?php
require_once(__DIR__ . '/../db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $flr_id = $_POST['follower_id'];
    $flg_id = $_POST['following_id'];

    $follower_id = mysqli_escape_string($conn, $flr_id);
    $following_id = mysqli_escape_string($conn, $flg_id);

    $checkFollowQuery = "SELECT * FROM follows WHERE follower_id=$follower_id AND following_id=$following_id";

    $checkFollowResult = $conn->query($checkFollowQuery);

    if ($checkFollowResult->num_rows == 0) {
        $insertFollowQuery = "INSERT INTO follows (follower_id, following_id) VALUES($follower_id, $following_id)";

        if ($conn->query($insertFollowQuery) === TRUE) {
            http_response_code(201);
            echo json_encode(array("message" => "Follow success"));
        } else {
            http_response_code(500);
            echo json_encode(array("message" => "Follow failed"));
        }

    } else {
        $unfollowQuery = "DELETE FROM follows WHERE follower_id=$follower_id AND following_id=$following_id";
        if ($conn->query($unfollowQuery) === TRUE) {
            http_response_code(201);
            echo json_encode(array("message" => "Unfollow success"));
        } else {
            http_response_code(500);
            echo json_encode(array("message" => "Unfollow failed"));
        }
    }


} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $us_id = $_GET['user_id'];
    $user_id = mysqli_escape_string($conn, $us_id);
    $checkFollowingQuery = "SELECT * FROM follows WHERE follower_id=$user_id";
    $checkFollowerQuery = "SELECT * FROM follows WHERE following_id=$user_id";

    $checkFollowingResult = $conn->query($checkFollowingQuery);
    $checkFollowerResult = $conn->query($checkFollowerQuery);

    $data = 
    [
        "followers" => mysqli_num_rows($checkFollowerResult),
        "following" => mysqli_num_rows($checkFollowingResult)

    ];

    echo json_encode($data);

} else {
    http_response_code(405);
    echo json_encode(array("message" => "Method Not Allowed"));
}


?>