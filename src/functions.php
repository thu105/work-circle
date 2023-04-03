<?php
  $host = 'localhost';
  $dbname = 'workcircle';
  $username = 'root';
  $password = '';
  $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
  $options =
  [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
  ];

  try
  {
    $pdo = new PDO($dsn, $username, $password, $options);
  }
  catch (PDOException $e)
  {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
  }

  function createTable($name, $query)
  {
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table '$name' created or already exists.<br>";
  }

  function queryMysql($query)
  {
    global $pdo;
    return $pdo->query($query);
  }

  function destroySession()
  {
    $_SESSION=array();

    if (session_id() != "" || isset($_COOKIE[session_name()]))
      setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
  }

  function sanitizeString($var)
  {
    global $pdo;

    $var = strip_tags($var);
    $var = htmlentities($var);

    $result = $pdo->quote($var);          // This adds single quotes
    return str_replace("'", "", $result); // So now remove them
  }

  function showProfile($user)
  {
    global $pdo;
    echo "<div class='container mt-5'>
          <div class='card text-bg-light'>
          <h3 class='card-header'>Your Profile</h3>
          <div class='row'>
            <div class='col-md-4'>";

    if (file_exists("img\\$user.jpg"))
      echo "<img src='img\\$user.jpg' class='img-fluid rounded-start'>";
    else
      echo "<img src='placeholder.jpg' class='img-fluid rounded-start'>";

    $result = $pdo->query("SELECT * FROM profiles WHERE user='$user'");

    echo "</div>
          <div class='col-md-8'>
            <div class='card-body'>
              <h5 class='card-title'>$user</h5>
              <p class='card-text'>";
    while ($row = $result->fetch())
    {
      echo stripslashes($row['text']).'<br>';
    }
    echo '      </p>
              </div>
            </div>
          </div>
        </div>';
  }
?>