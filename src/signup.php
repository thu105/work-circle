<!doctype html>
<html lang="en">

<?php
require_once 'header.php';
?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-8 col-sm-10">
      <h2 class="text-center mb-4">Create a WorkCircle account</h2>
      <?php
        if (isset($_SESSION['error'])) {
          echo '<div class="alert alert-danger" role="alert">
            Error: '.$_SESSION['error'].'
          </div>';
          unset($_SESSION['error']);
        }
      ?>
      <form action="authenticate.php" method="post">
        <div class="form-group my-3">
          <input type="text" class="form-control" id="username" name="username" placeholder="Your Username *" required>
        </div>
        <div class="form-group my-3">
          <input type="password" class="form-control" id="password" name="password" placeholder="Your Password *" required>
        </div>
        <div class="form-group my-3">
          <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm Your Password *" required>
        </div>
        <button type="submit" class="btn btn-primary w-100 my-3" name="signup">Signup</button>
      </form>
    </div>
  </div>
</div>

</html>