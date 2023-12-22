<?php

require_once(__DIR__ . '/../db.php');
require_once(__DIR__ . '/../docs/api_url.php');


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $un = $_GET['username'];

    $username = mysqli_real_escape_string($conn, $un);

    $checkUsernameQuery = "SELECT * FROM users WHERE username = '$username'";
    $checkUsernameResult = $conn->query($checkUsernameQuery);

    if ($checkUsernameResult->num_rows == 0) {
        http_response_code(400);
        echo json_encode(array("message" => "Invalid username"));
    } else {
        $row = $checkUsernameResult->fetch_row();
        $apiUrl = "$follow?user_id=$row[0]";
        $followData = json_decode(file_get_contents($apiUrl), true);
        $userdata =
            [
                "name" => $row[4],
                "username" => $row[1],
                "followers" => $followData["followers"],
                "following" => $followData["following"],
                "created_at" => $row[5],
                "last_visited" => $row[6]

            ];
        http_response_code(200);
        echo json_encode($userdata);

    }
} else {
    http_response_code(405);
    echo json_encode(array("message" => "Method Not Allowed"));
}

?>