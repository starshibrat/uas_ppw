<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add an account</title>
    <link rel="stylesheet" href="styles/adminform.css">
</head>

<body>

<a href="panel.php">Back to admin panel</a>

<header>Add an Account</header>
        <form method="post" action="admin_add.php">
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

</body>

</html>