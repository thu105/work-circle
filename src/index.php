<!doctype html>
<html lang="en">

<?php
require_once 'header.php';
if($loggedin) {
  header('Location: '.$uri.'/profile.php');
} else {
  header('Location: '.$uri.'/login.php');
}
?>

</html>