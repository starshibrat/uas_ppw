<?php
require_once(__DIR__ . '/models/user_model.php');
require_once(__DIR__ . '/models/post_model.php');
require_once(__DIR__ . '/server/docs/api_url.php');

$response = file_get_contents($get_all_tweet);

session_start();

if (!isset($_SESSION["token"])) {
  sleep(1);
  header("Location: index.php");
}

$user = $_SESSION["current_user"];


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/dashboard.css">
  <title>Dashboard</title>
</head>

<body>
  <div class="topnav">
    <form method="get" action="search.php">
      <input type="text" name="q" placeholder="Search..">
      <button type="submit">Search</button>
    </form>
  </div>

  <div class="profile-sidebar">
    <div class="sidebar-content">
      <div class="username-sidebar">
        <?php echo $user->username; ?>
      </div>
      <div class="followers">
        Followers:
        <?php echo $user->followers; ?>
      </div>
      <div class="following">
        Following:
        <?php echo $user->following; ?>
      </div>
      <div class="bio">
        About Me:
        <?php echo $user->bio; ?>
      </div>

      <form method="post" action="setting.php">
        <input type="hidden" name="user_id" value=<?php echo $user->id ?>>
        <button type="submit" class="modif-button">Modify Account</submit>
      </form>

      <form method="post" action="logout.php">
        <button type="submit" class="logout-button">Logout</submit>
      </form>
    </div>

  </div>

  <div class="posts">
    <div class="create-post">
      <h1>Share your thoughts today!</h1>
      <form method="post" action="<?php echo $tweet ?>">
        <input type="hidden" name="user_id" value=<?php echo $user->id ?>>
        <textarea name="post_text"></textarea>
        <br>
        <button type="submit">Post</button>

      </form>
    </div>
    <?php
    for ($i = $response; $i > 0; $i--) {

      $post = new Post($i);

      $love_post_url = $love . "?user_id=" . $user->id . "&post_id=" . $post->id;
      $res = file_get_contents($love_post_url);

      echo '<div class="post">';

      if ($post->author == $user->username) {
        echo '<div class="author-name">' . $post->author . ' (Me)</div>';
      } else {

        echo "<a href='profile.php?id=$post->author_id'>";

        echo '<div class="author-name">' . $post->author . '</div></a>';
      }
      echo $post->created_at;
      echo "<br>";
      echo '<div class="post-content">';

      echo $post->content;
      echo "<br>";
      echo '</div>';

      echo "<form method='post' action='$love'>";

      $user_id = $user->id;
      $post_id = $post->id;

      echo "<input type='hidden' name='user_id' value='$user_id'>";
      echo "<input type='hidden' name='post_id' value='$post_id'>";

      if ((int) $res == 0) {
        echo "<button type='submit' class='upvote'>";
        echo "[+] Upvote";
      } else {
        echo "<button type='submit' class='downvote'>";
        echo "[-] Downvote";
      }
      echo "</button>";
      echo '(' . $post->loves . ')';

      echo "</form>";


      echo '</div>';





    }

    ?>
  </div>

</body>

</html>