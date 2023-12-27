<?php
require_once(__DIR__ . '/server/db.php');
require_once(__DIR__ . '/models/user_model.php');
include(__DIR__ . '/server/docs/api_url.php');
session_start();




$user = $_SESSION["current_user"];

$user_id = $_GET['id'];

$flr_id = $user->id;
$flg_id = $user_id;

$follower_id = mysqli_escape_string($conn, $flr_id);
$following_id = mysqli_escape_string($conn, $flg_id);

$checkFollowQuery = "SELECT * FROM follows WHERE follower_id=$follower_id AND following_id=$following_id";

$checkFollowResult = $conn->query($checkFollowQuery);

$isfollowing = FALSE;

if ($checkFollowResult->num_rows > 0) {
    $isfollowing = TRUE;
}



$url = "$getUserById?id=" . $user_id;

$response = file_get_contents($url);

$responseJson = json_decode($response, true);

$email = "someone@somewhere.com";
$default = "https://www.somewhere.com/homestar.jpg";
$size = 40;

$username = $responseJson["username"];
$followers = $responseJson["followers"];
$following = $responseJson["following"];
$created_at = $responseJson["created_at"];
$bio = $responseJson["bio"];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $user->username; ?>'s Profile Page
    </title>
    <link rel="stylesheet" href="styles/profile.css">
</head>

<body>

    <a href="dashboard.php">Back to Dashboard</a>

            <h2 id="username">
                <?php echo $username; ?>
            </h2>

            <br>
            <form action="<?php echo $follow ?>" method="post">
                <input type="hidden" name="follower_id" value=<?php echo $flr_id ?>>
                <input type="hidden" name="following_id" value=<?php echo $flg_id ?>>

                <button type="submit">
                    <?php

                    if ($isfollowing == TRUE) {
                        echo "Unfollow [-]";
                    } else {
                        echo "Follow [+]";
                    }

                    ?>
                </button>

            </form>
            <br>

            <h3 id="followers">Followers:
                <?php echo $followers; ?>
            </h3>
            <h3 id="following">Following:
                <?php echo $following; ?>
            </h3>
            <h3 id="join_at">Member since:
                <?php echo $created_at; ?>
            </h3>
            <h3 id="bio">
                About Me:
                <?php echo $bio ?>
            </h3>

</body>

</html>