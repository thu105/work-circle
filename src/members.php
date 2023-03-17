<!doctype html>
<html lang="en">

<?php
require_once 'header.php';

if(!$loggedin){
  header('Location: '.$uri.'/login.php');
  exit();
}

// Add Member Directory Here

if (isset($_GET['view'])) {
  $view = sanitizeString($_GET['view']);

  if ($view == $user) $name = "Your";
    else                $name = "$view's";

  // echo "<h3>$name Profile</h3>";
  // showProfile($view);

  // echo "<a data-role='button' data-transition='slide'
  //         href='messages.php?view=$view&r=$randstr'>View $name messages</a>";
  // die("</div></body></html>");

  
}
?>


</html>