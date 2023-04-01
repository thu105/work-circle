<!DOCTYPE html> <!-- Example 03: setup.php -->
<html>
  <head>
    <title>Setting up WorkCircle database</title>
  </head>
  <body>
    <h3>Creating required tables...</h3>

<?php
  require_once 'functions.php';

  createTable('user',
              'user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              username VARCHAR(255) NOT NULL UNIQUE,
              password VARCHAR(64) NOT NULL,
              INDEX(username(6))');
  createTable('profiles',
              'user VARCHAR(16),
              text VARCHAR(4096),
              INDEX(user(6))');
  createTable('friends',
              'username VARCHAR(255) NOT NULL,
              friend VARCHAR(255),
              INDEX(username(6)),
              INDEX(friend(6))');
  createTable('messages', 
              'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              sender VARCHAR(16),
              receiver VARCHAR(16),
              pm CHAR(1),
              time INT UNSIGNED,
              message VARCHAR(4096),
              INDEX(sender(6)),
              INDEX(receiver(6))');
?>

    <br>Completed.
  </body>
</html>