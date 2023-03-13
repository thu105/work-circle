<?php
require_once 'header.php';

function authenticateUser(string $username, string $password): bool{
  return true;
}

if (isset($_POST['login'])){
  if(authenticateUser(sanitizeString($_POST['username']),sanitizeString($_POST['password']))){
    $_SESSION['username']=sanitizeString($_POST['username']);
    header('Location: '.$uri.'/profile.php');
    exit();
  } else {
    $_SESSION['error']='LOGIN ERROR';
    unset($_SESSION['username']);
  }
  header('Location: '.$uri.'/login.php');
} else if (isset($_POST['signup'])) {
  $_SESSION['error']='SIGNUP ERROR';
  header('Location: '.$uri.'/signup.php');
}

?>