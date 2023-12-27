<?php
require_once(__DIR__ . '/server/db.php');
session_start();
if (!isset($_SESSION["admin_token"])) {
    sleep(1);
    header("Location: admin_login.php");
}

$checkUserQuery = "SELECT * FROM users";
$checkUserResult = $conn->query($checkUserQuery);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles/panel.css">
</head>

<body>
    <div class="admin-add">
        <a href="admin_add_form.php"><button>Add new User</button></a>
    </div>

    <table class="user-list">
        <tr>
            <th>User</th>
            <th>Actions</th>
        </tr>

        <?php
        while ($row = $checkUserResult->fetch_assoc()) {
            $id = $row["user_id"];

            echo "<tr>";
            echo "<td>";
            echo "<a href='profile.php?id=" . $row["user_id"] . "'>" . $row["username"] . "</a><br>";
            echo "</td>";
            echo "<td>";
            echo "<form action='modify.php' method='post'>
            <input type='hidden' name='user_id' value=$id>
            <button type='submit'>Modify</button>
            </form><br>";

            echo "<form action='admin_delete.php' method='post'>
            <input type='hidden' name='user_id' value=$id>
            <button type='submit'>Delete</button>
            </form>";

            echo "</td>";

            echo "</tr>";

        }
        ?>
    </table>

</body>

</html>