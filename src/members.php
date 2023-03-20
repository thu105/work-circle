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
  else $name = "$view's";

  
  // showProfile($view);

  // echo "<a data-role='button' data-transition='slide'
  //         href='messages.php?view=$view&r=$randstr'>View $name messages</a>";
  //die("</div></body></html>");
}


  if (isset($_GET['add']))
  {
    $add = sanitizeString($_GET['add']);
    $result = queryMysql("SELECT * FROM friends
      WHERE username='$add' AND friend='$user'");
    
    if (!$result->rowCount())
      queryMysql("INSERT INTO friends VALUES ('$add', '$user')");
  }
  elseif (isset($_GET['remove']))
  {
    $remove = sanitizeString($_GET['remove']);
    queryMysql("DELETE FROM friends
      WHERE username='$remove' AND friend='$user'");
  }


  $result = queryMysql("SELECT username FROM user ORDER BY user_id");
  $num    = $result->rowCount();
  echo "<div class='container mt-5 py-10'>
          <h2> Members </h2>
          <ul class='list-group'>";
  while ($row = $result->fetch())
  {
    if ($row['username'] == $user) continue;

    echo "<li class='list-group-item'><a data-transition='slide' href='members.php?view=" .
      $row['username'] . "&$randstr'>" . $row['username'] . "</a>";
    $follow = "follow";

    $result1 = queryMysql("SELECT * FROM friends WHERE
      username='" . $row['username'] . "' AND friend='$user'");
    $t1      = $result1->rowCount();

    $result1 = queryMysql("SELECT * FROM friends WHERE
      username='$user' AND friend='" . $row['username'] . "'");
    $t2      = $result1->rowCount();

    if (($t1 + $t2) > 1) echo " &harr; is a mutual friend";
    elseif ($t1)         echo " &larr; you are following";
    elseif ($t2)       { echo " &rarr; is following you";
                         $follow = "recip"; }

    if (!$t1) echo " [<a data-transition='slide'
      href='members.php?add=" . $row['username'] . "&r=$randstr'>$follow</a>]";
    else      echo " [<a data-transition='slide'
      href='members.php?remove=" . $row['username'] . "&r=$randstr'>drop</a>]";

  }
?>
    </ul></div>
  </body>

</html>