<?php
session_start();

if (isset($_SESSION["admin_token"])) {
    sleep(1);
    header("Location: panel.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles/login.css">
</head>

<body>
    <div class="container">
        <header>Admin Login</header>
        <form method="post" action="admin_auth.php">
            <div class="input-field">
                <input type="text" name="username" required>
                <label>Username</label>
            </div>
            <div class="input-field">
                <input class="pswrd" type="password" name="password" required>
                <label>Password</label>
            </div>

            <div class="button">
                <div class="inner"></div>
                <button type="submit" name="lgnbtn">LOGIN</button>
            </div>




        </form>
    </div>

</body>

</html>