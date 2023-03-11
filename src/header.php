<?php
session_start();
require_once 'functions.php';

if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
  $uri = 'https://';
} else {
  $uri = 'http://';
}
$uri .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$uri = substr($uri,0,strripos($uri,'/'));

$login_status = 'Unauthorized';
$randstr = substr(md5(rand()), 0, 7);
$loggedin = FALSE;
if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
  $loggedin = TRUE;
  $login_status = "Logged in as: $user";
}
?>

<head>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>WorkCircle</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-secondary">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">WorkCircle</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="me-auto mb-2 mb-lg-0">
        </div>

        <ul class="navbar-nav">
          <li class="nav-item px-1">
            <a class="nav-link" href="members.php">Members</a>
          </li>
          <li class="nav-item px-1">
            <a class="nav-link" href="friends.php">Friends</a>
          </li>
          <li class="nav-item px-1">
            <a class="nav-link" href="messages.php">Messages</a>
          </li>
          <?php
          if ($loggedin) {
            echo '<li class="nav-item px-1">
                <a class="nav-link" href="profile.php">Profile</a>
              </li>
              <li class="nav-item px-1">
                <button class="btn btn-outline-success" type="logout">Logout</button>
              </li>';
          } else {
            echo '<li class="nav-item p-1">
                <form action="signup.php" method="post" id="signup">
                  <button class="btn btn-primary" type="submit">Signup</button>
                </form>
              </li>
              <li class="nav-item p-1">
                <form action="login.php" method="post" id="login">
                  <button class="btn btn-outline-success" type="submit">Login</button>
                </form>
              </li>';
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
</body>