<?php
include_once 'api_url.php';
$apiUrl = "$user?username=hosono_haruki";
$response = file_get_contents($apiUrl);
$responseJson = json_decode($response, true);
// var_dump($responseJson);
$name = $responseJson['name'];
$username = $responseJson['username'];
$created_at = $responseJson['created_at'];
$last_visited = $responseJson['last_visited'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Get User</title>
</head>
<body>
    <h3>Nama: <?php echo $name; ?></h3>
    <h3>Username: <?php echo $username; ?></h3>
    <h3>Joined at: <?php echo $created_at; ?></h3>
    <h3>Last visit: <?php echo $last_visited; ?></h3>
    
</body>
</html>