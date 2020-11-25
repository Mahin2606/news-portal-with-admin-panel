<?php
  ob_start();
  include("inc/db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Recover Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>Admin </b>Login</a>
  </div>
  <!-- /.login-logo -->

  <?php
    if (isset($_POST['changePass'])) {
      $email          = $_POST['email'];
      $oldPassword    = $_POST['oldPassword'];
      $newPassword    = $_POST['newPassword'];
      $reNewPassword  = $_POST['reNewPassword'];

      $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$oldPassword'";
      $readUser = mysqli_query($db, $sql);
      $userCount = mysqli_num_rows($readUser);

      if ($userCount > 0) {
        if ($_POST['newPassword'] == $_POST['reNewPassword']) {
          $hassedPass = sha1($newPassword);

          $query = "UPDATE users SET password='$hassedPass' WHERE email = '$email'";
          $updatePass = mysqli_query($db, $query);
          
          if ($updatePass) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Congratulations!</strong> Your password has been updated. Now please login to continue!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
          }
          else {
            die("MySQLi Query Failed." . mysqli_error($db));
          }
        }
        else {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>New and Retype New Password Mismatched!</strong> Please give same passwords!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>';
        }
      }
      else {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Wrong Password!</strong> Please give your old valid password!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
    }
  ?>

  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You are only one step a way from your new password, recover your password now!</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Old Password" name="oldPassword" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="New Password" name="newPassword" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype New Password" name="reNewPassword" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <input type="submit" name="changePass" class="btn btn-primary btn-block" value="Change Password">
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <hr>
        <a href="index.php" class="btn btn-block btn-danger">
          <i class="fas fa-sign-in-alt mr-2"></i> Login to Admin Panel
        </a>
      </div>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<?php
  ob_end_flush();
?>

</body>
</html>
