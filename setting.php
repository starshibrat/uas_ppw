<?php
require_once(__DIR__ . '/server/db.php');

$id = $_POST["user_id"];
$user_id = mysqli_escape_string($conn, $id);

$checkUserQuery = "SELECT * FROM users WHERE user_id=$user_id";


$checkUserResult = $conn->query($checkUserQuery);

$row = $checkUserResult->fetch_row();

$username = $row[1];
$email = $row[3];
$nama = $row[4];
$bio = $row[7];
$id = $row[0];



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Profile</title>
    <link rel="stylesheet" href="styles/setting.css">
</head>

<body>
    <a href="dashboard.php" class="back-link">Back to Dashboard</a>
    <div class="modify-form">
        <form method="post" action="update_setting.php">
            <input type='hidden' name="id" value=<?php echo $id; ?>>
            <label for='username'>Username</label>
            <input type='text' name='username' value=<?php echo $username; ?>>
            <label for='email'>Email</label>
            <input type='email' name='email' value=<?php echo $email; ?>>
            <label for='bio'>Bio</label>
            <textarea name='bio'>
                <?php echo $bio; ?>
                </textarea>

            <button type="submit">Submit</button>
        </form>
    </div>

</body>

</html>