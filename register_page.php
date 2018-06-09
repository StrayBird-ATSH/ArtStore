<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chapter 9</title>
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/site_theme.css" rel="stylesheet">
</head>
<body>
<?php include 'includes\art-header.inc.php';
if (isset($_POST)) {
  require_once 'includes\config.php';
  $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
  $connection->query("SET NAMES utf8");
  $error = mysqli_connect_error();
  if ($error != null) {
    $output = "<p>Unable to connect to database<p>" . $error;
    exit($output);
  }
  $email = $_POST['email'];
  $sql = "SELECT COUNT(*) FROM users WHERE email=$email";
  $result = mysqli_query($connection, $sql);
  if ($result === 0) {

  }
}


?>
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-heading">Account</div>
        <div class="panel-body">
          <ul class="nav nav-pills nav-stacked">
            <li><a href="#">Login</a></li>
            <li class="active"><a href="#">Register</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <form role="form" class="form-horizontal" action="register_page.php" method="post">
        <div class="page-header">
          <h2>Register Account</h2>
          <p>If you already have an account with us, please login at the login page.</p>
        </div>
        <div class="form-group">
          <label for="first" class="col-md-3 control-label">First Name</label>
          <div class="col-md-9">
            <input type="text" class="form-control" name="first" title="">
          </div>
        </div>
        <div class="form-group">
          <label for="last" class="col-md-3 control-label">Last Name</label>
          <div class="col-md-9">
            <input type="text" class="form-control" name="last" title="">
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-md-3 control-label">Email</label>
          <div class="col-md-9">
            <input type="email" class="form-control" name="email" title="">
          </div>
        </div>
        <div class="form-group">
          <label for="password1" class="col-md-3 control-label">Password</label>
          <div class="col-md-9">
            <input type="password" class="form-control" name="password1" title="">
          </div>
        </div>
        <div class="form-group">
          <label for="password2" class="col-md-3 control-label">Password Confirm</label>
          <div class="col-md-9">
            <input type="password" class="form-control" name="password2" title="">
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-offset-3 col-md-9">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="privacy"> I agree to the <a href="#">privacy policy</a>
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-offset-3 col-md-9">
            <button type="submit" class="btn btn-primary">Register</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php include 'art-footer.inc.php' ?>
<script src="js/jquery.js"></script>
<script src="js/confirmation.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
