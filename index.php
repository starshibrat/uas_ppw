<?php
require_once(__DIR__ . '/server/docs/api_url.php');
require_once(__DIR__ . '/models/user_model.php');
session_start();

if (isset($_SESSION["token"])) {
   sleep(1);
   header("Location: dashboard.php");
}

$a = rand(1, 9);
$b = rand(1, 9);


?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
   <link rel="stylesheet" href="styles/login.css">
</head>

<body>
   <div class="container">
      <header>Login</header>
      <form method="post" action=<?php echo $login; ?>>
         <input type="hidden" name="correct_answer" value=<?php echo $a + $b; ?>>
         <div class="input-field">
            <input type="text" name="username" required>
            <label>Username</label>
         </div>
         <div class="input-field">
            <input class="pswrd" type="password" name="password" required>
            <label>Password</label>
         </div>
         <div class="captcha">
            <div class="captcha-content">

               <?php echo $a . " + " . $b . " = "; ?>

            </div>
            <div class="captcha-answer">
               <input type="text" name="answer" required>
            </div>
         </div>
         <div class="button">
            <div class="inner"></div>
            <button type="submit" name="lgnbtn">LOGIN</button>
         </div>




      </form>

      <div class="auth">
         Or login with
      </div>
      <div class="links">
         <div class="google">
            <i class="fab fa-google-plus-square"><span>Google</span></i>
         </div>
      </div>
      <div class="signup">
         don't have an account ? <a href="register.php">Signup now</a>
      </div>
   </div>
</body>

</html>