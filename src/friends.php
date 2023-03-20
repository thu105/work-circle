<!doctype html>
<html lang="en">

<?php
require_once 'header.php';

if(!$loggedin){
  header('Location: '.$uri.'/login.php');
  exit();
}

// Add Friend List Here
if (isset($_GET['view'])) $view = sanitizeString($_GET['view']);
  else $view = $user;

  if ($view == $user)
  {
    $name1 = $name2 = "Your";
    $name3 = "You are";
  }
  else
  {
    $name1 = "<a data-transition='slide'
              href='members.php?view=$view&r=$randstr'>$view</a>'s";
    $name2 = "$view's";
    $name3 = "$view is";
  }

  // Uncomment this line if you wish the user’s profile to show here
  showProfile($view);

  $followers = array();
  $following = array();

  $result = queryMysql("SELECT * FROM friends WHERE username='$view'");

  $j = 0;
  
  while ($row = $result->fetch())
  {
    $followers[$j++] = $row['friend'];
  }

  $result = queryMysql("SELECT * FROM friends WHERE friend='$view'");

  $j = 0;

  while ($row = $result->fetch())
  {
    $following[$j++] = $row['username'];
  }

  $mutual    = array_intersect($followers, $following);
  $followers = array_diff($followers, $mutual);
  $following = array_diff($following, $mutual);
  $friends   = FALSE;

  echo "<br>";
  
  if (sizeof($mutual))
  {
    echo "<h2>$name2 mutual friends</h2>
          <ul class='list-group'>";
    foreach($mutual as $friend)
      echo "<li class='list-group-item'><a data-transition='slide'
            href='members.php?view=$friend&r=$randstr'>$friend</a>";
    echo "</ul>";
    $friends = TRUE;
  }

  if (sizeof($followers))
  {
    echo "<h2>$name2 followers</h2><ul class='list-group'>";
    foreach($followers as $friend)
      echo "<li class='list-group-item'><a data-transition='slide'
            href='members.php?view=$friend&r=$randstr'>$friend</a>";
    echo "</ul>";
    $friends = TRUE;
  }

  if (sizeof($following))
  {
    echo "<h2>$name3 following</h2><ul class='list-group'>";
    foreach($following as $friend)
      echo "<li class='list-group-item'><a data-transition='slide'
            href='members.php?view=$friend&r=$randstr'>$friend</a>";
    echo "</ul>";
    $friends = TRUE;
  }

  if (!$friends) echo "<br>You don't have any friends yet.";

?>

</html>
