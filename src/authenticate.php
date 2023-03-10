<!doctype html>
<html lang="en">

<?php
require_once 'header.php';
?>

<div class="container-fluid justify-content-center p-5">
  <div class="row text-center">
    <h4> Please login or signup to access this app.</h4>
  </div>

  <div class="row text-center">
    <h4>
      <?php
      if (isset($_POST['login'])) {
        echo 'LOGIN FORM';
      } else if (isset($_POST['signup'])) {
        echo 'SINGUP FORM';
      } else {
        echo 'LOGIN FORM';
      }
      ?>
    </h4>
  </div>
</div>

</html>