<?php 
include_once 'api_url.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test register</title>
</head>
<body>
<form action=<?php echo $register; ?> method="post">
    <input type="text" placeholder="username" name="username" required>
    <input type="email" placeholder="email" name="email" required>
    <input type="password" placeholder="password" name="password" required>
    <button type="submit">Submit</button>
    


</form>

    
</body>
</html>