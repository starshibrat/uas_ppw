<?php 
include_once 'api_url.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Tweet</title>
</head>
<body>

    <form action=<?php echo $tweet ?> method="POST">
        <input type="text" name="user_id" placeholder="User ID" required>
        <input type="text" name="post_text" placeholder="Content (max 140)" required>
        <button type="submit">Submit</button>

    </form>
    
</body>
</html>