<?php
require_once 'header.php';

function authenticateUser(string $username, string $password): bool{
  return true;
}

function singupUser(string $username, string $password, string $confirmPassword): bool {
  $result = queryMysql("SELECT * FROM user WHERE username='$username'");
  if($result->rowCount()){
    $_SESSION['error']="The username $username is taken.";
    return false;
  }

  if($password != $confirmPassword){
    $_SESSION['error']="Passwords do not match.";
    return false;
  }

  if(strlen($password) < 8 || !preg_match('@[A-Z]@', $password) || !preg_match('@[a-z]@', $password) || !preg_match('@[0-9]@', $password) || !preg_match('@[^\w]@', $password)) {
    $_SESSION['error']="Password is too weak. Make sure it has an uppercase, a lowercase, a special character, and a number, and it is at least 8 characters long.";
    return false;
  }

  $passwordHash = hash('sha256', $password);
  try {
    $result = queryMysql("INSERT INTO user (username, password) VALUES ('$username','$passwordHash');");
  } catch (PDOException $e) {
    $_SESSION['error']=$e->getMessage();
    return false;
  }

  $_SESSION['username']=$username;
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
  if (singupUser(sanitizeString($_POST['username']),sanitizeString($_POST['password']),sanitizeString($_POST['confirm-password']))){
    header('Location: '.$uri.'/profile.php');
  } else {
    header('Location: '.$uri.'/signup.php');
  }
} else if (isset($_POST['logout'])) {
  destroySession();
  header('Location: '.$uri.'/index.php');
} else {
  header('Location: '.$uri.'/index.php');
}

?>