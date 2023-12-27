<?php

require_once(__DIR__ . '/server/db.php');


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $q = $_GET['q'];

    $username = mysqli_real_escape_string($conn, $q);

    $checkUsernameQuery = "SELECT * FROM users WHERE username LIKE '%$q%'";
    $checkUsernameResult = $conn->query($checkUsernameQuery);

    $user_empty = FALSE;

    if ($checkUsernameResult->num_rows == 0) {
        $user_empty = TRUE;
    }
    //else {
    //     while ($row = $checkUsernameResult->fetch_assoc()){
    //         echo $row["username"]."<br>";
    //     }
    // }

    $post_empty = FALSE;

    $checkPostQuery = "SELECT * FROM posts WHERE post_text LIKE '%$q%'";
    $checkPostResult = $conn->query($checkPostQuery);
    if ($checkPostResult->num_rows == 0) {
        $post_empty = TRUE;
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results (
        <?php echo (mysqli_num_rows($checkPostResult) + mysqli_num_rows($checkUsernameResult)) ?>)
    </title>
    <link rel="stylesheet" href="styles/search.css">
</head>

<body>

    <a href="dashboard.php">Back to Dashboard</a>

    <h1>Results for : <?php echo $q ?></h1>

    <h2> Users </h2>

    <div class="user-result">
        <?php

        while ($row = $checkUsernameResult->fetch_assoc()) {

            echo "<a href='profile.php?id=" . $row["user_id"] . "'>" . $row["username"] . "</a><br>";

        }



        ?>
    </div>

    <h2> Posts </h2>

    <div class="post-result">
        <?php

        while ($row = $checkPostResult->fetch_assoc()) {

            echo $row["post_date"]."\t".$row["post_text"] . "<br>";

        }



        ?>
    </div>


</body>

</html>