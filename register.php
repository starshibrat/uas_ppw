<?php
require_once(__DIR__ . '/server/docs/api_url.php');
require_once(__DIR__ . '/models/user_model.php');
session_start();

if (isset($_SESSION["token"])) {
    sleep(1);
    header("Location: dashboard.php");
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="styles/login.css">
</head>

<body>
    <div class="container">
        <header>Register</header>
        <form method="post" action=<?php echo $register; ?>>
            <div class="input-field">
                <input type="text" name="username" required>
                <label>Username</label>
            </div>
            <div class="input-field">
                <input type="text" name="email" required>
                <label>Email</label>
            </div>
            <div class="input-field">
                <input class="pswrd" type="password" name="password" required>
                <label>Password</label>
            </div>

            <div class="button">
                <div class="inner"></div>
                <button type="submit" name="lgnbtn">Register</button>
            </div>
        </form>

        <div class="signup">
         already have an account ? <a href="index.php">Login now</a>
      </div>
    </div>


</body>

</html>