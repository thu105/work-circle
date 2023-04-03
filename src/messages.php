<?php 
  require_once 'header.php';

  if(!$loggedin){
    $_SESSION['error']="You need to be logged in to access the app.";
    header('Location: '.$uri.'/login.php');
    exit();
  }

  if (isset($_GET['view'])) $view = sanitizeString($_GET['view']);
  else                      $view = $user;

  if (isset($_POST['text']))
  {
    $text = sanitizeString($_POST['text']);

    if ($text != "")
    {
      $pm   = substr(sanitizeString($_POST['pm']),0,1);
      $time = time();
      queryMysql("INSERT INTO messages VALUES(NULL, '$user',
        '$view', '$pm', $time, '$text')");
    }
  }

  if ($view != "")
  {
    if ($view == $user) $name1 = $name2 = "Your";
    else
    {
      $name1 = "<a href='members.php?view=$view&r=$randstr'>$view</a>'s";
      $name2 = "$view's";
    }
    showProfile($view);
    

    echo <<<_END
    <div class="container mt-5 py-10">
      <h3>$name1 Messages</h3>
      <form method='post' action='messages.php?view=$view&r=$randstr'>
        <h5>Type here to leave a message</h5>
        <div class="form-group my-3">
          <div class="form-check-inline">
            <input class="form-check-input" type="radio" name="pm" id="public" value="0" checked>
            <label class="form-check-label" for="public">
              Public
            </label>
          </div>
          <div class="form-check-inline">
            <input class="form-check-input" type="radio" name="pm" id="private" value="1">
            <label class="form-check-label" for="private">
              Private
            </label>
          </div>
        </div>
        <div class="form-group">
          <textarea class="form-control" id="text" name="text"></textarea>
        </div>
      <button type="submit" class="btn btn-primary w-100 my-3" value='Post Message'> PostMessage </button>
    </form>
_END;

    date_default_timezone_set('UTC');

    if (isset($_GET['erase']))
    {
      $erase = sanitizeString($_GET['erase']);
      queryMysql("DELETE FROM messages WHERE id='$erase' AND receiver='$user'");
    }
    
    $query  = "SELECT * FROM messages WHERE receiver='$view' ORDER BY time DESC";
    $result = queryMysql($query);
    $num    = $result->rowCount();

    if($num){
      echo "<ul class='list-group'>";
      while ($row = $result->fetch())
      {
        if ($row['pm'] == 0 || $row['sender'] == $user || $row['receiver'] == $user)
        {
          echo "<li class='list-group-item'>";
          echo date('M jS \'y g:i a:', $row['time']);
          echo " <a href='messages.php?view=" . $row['sender'] .
              "&r=$randstr'>" . $row['sender']. "</a> ";

          if ($row['pm'] == 0)
            echo "wrote: &quot;" . $row['message'] . "&quot; ";
          else
            echo "whispered: <span class='whisper'>&quot;" .
              $row['message']. "&quot;</span> ";

          if ($row['receiver'] == $user)
            echo "[<a href='messages.php?view=$view" .
                "&erase=" . $row['id'] . "&r=$randstr'>erase</a>]";

          echo "</li>";
        }
      }
      echo "</ul>";
    } else {
      echo '<div class="alert alert-primary" role="alert"> No messages yet </div>';
    }
  }
  echo "<br><a class='btn btn-primary'
        href='messages.php?view=$view&r=$randstr'>Refresh messages</a>";
?>
    </div><br>
  </div>
</html>