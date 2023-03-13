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
              password VARCHAR(255) NOT NULL,
              INDEX(username(6))');
?>

    <br>Completed.
  </body>
</html>