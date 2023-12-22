<?php 
include_once 'api_url.php';

$apiUrl = "$getTweet?post_id=2";
$response = file_get_contents($apiUrl);
$responseJson = json_decode($response, true);

$content = $responseJson["post_text"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Get Tweet</title>
</head>
<body>
    <h1><?php echo $content;?></h1>
</body>
</html>