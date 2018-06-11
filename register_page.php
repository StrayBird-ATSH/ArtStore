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
<?php
session_start();
include 'art-header.inc.php';
function saltHash($originalPassword)
{
  $salt = "RandomSALT_HJFKJDKL";  //the random string is set here
  $longPassword = $originalPassword . $salt;
  //connects the original password with the random string
  $longHashPassword = md5($longPassword);  //perform  MD5 calculation
  return $longHashPassword;  //returns the new password
}

$status = '0';
if (isset($_POST['email'])) {
  require_once 'includes\config.php';
  $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
  $connection->query("SET NAMES utf8");
  $error = mysqli_connect_error();
  if ($error != null) {
    $output = "<p>Unable to connect to database<p>" . $error;
    exit($output);
  }
  $email = $_POST['email'];
  $sql = "SELECT COUNT(*) FROM users AS number WHERE email='$email'";
  $result = mysqli_query($connection, $sql);
  $row = $result->fetch_assoc();
  if ($row['COUNT(*)'] === '0') {
    if (isset($_POST['last']) && isset($_POST['password1']) &&
        isset($_POST['first'])) {
      $name = $_POST['first'] . " " . $_POST['last'];
      $longHashPassword = saltHash($_POST['password1']);
      $tel = $_POST['tel'];
      $address = $_POST['address'];
      $sql = "INSERT INTO users (name, email, password, balance,tel,address) 
                      VALUES ('$name','$email','$longHashPassword',0,$tel,$address)";
      if (mysqli_query($connection, $sql))
        $status = 'success';
      else $status = 'register failed';
    } else $status = 'missing something';
  } else $status = 'already registered';
}
?>
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-heading">Account</div>
        <div class="panel-body">
          <ul class="nav nav-pills nav-stacked">
            <li><a href="login.php">Login</a></li>
            <li class="active">
              <a href="register_page.php">Register</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <?php
      if ($status === 'success') {
        echo "<div class=\"alert alert-success alert-dismissible\" role=\"alert\">";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">";
        echo "<span aria-hidden=\"true\">&times;</span>";
        echo "</button>";
        echo "<strong>Success! </strong>";
        echo "You have successfully registered!</div>";
      } elseif ($status === 'register failed') {
        echo "<div class=\"alert alert-danger alert-dismissible\" role=\"alert\">";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">";
        echo "<span aria-hidden=\"true\">&times;</span>";
        echo "</button>";
        echo "<strong>Failed! </strong>";
        echo "Sorry! The registration failed.</div>";
      } elseif ($status === 'missing something') {
        echo "<div class=\"alert alert-info alert-dismissible\" role=\"alert\">";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">";
        echo "<span aria-hidden=\"true\">&times;</span>";
        echo "</button>";
        echo "<strong>Info </strong>";
        echo "Sorry! The form you submitted misses something</div>";
      } elseif ($status === 'already registered') {
        echo "<div class=\"alert alert-warning alert-dismissible\" role=\"alert\">";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">";
        echo "<span aria-hidden=\"true\">&times;</span>";
        echo "</button>";
        echo "<strong>Warning </strong>";
        echo "Sorry! The email is already registered</div>";
      }
      ?>
      <form role="form" class="form-horizontal"
            action="register_page.php" method="post">
        <div class="page-header">
          <h2>Register Account</h2>
          <p>If you already have an account with us,
            please login at the login page.</p>
        </div>
        <div class="form-group">
          <label for="first" class="col-md-3 control-label">First Name</label>
          <div class="col-md-9">
            <input type="text" class="form-control" required="required"
                   name="first" title="">
          </div>
        </div>
        <div class="form-group">
          <label for="last" class="col-md-3 control-label">Last Name</label>
          <div class="col-md-9">
            <input type="text" class="form-control" required="required"
                   name="last" title="">
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-md-3 control-label">Email</label>
          <div class="col-md-9">
            <input type="email" class="form-control" required="required"
                   name="email" title="">
          </div>
        </div>
        <div class="form-group">
          <label for="tel" class="col-md-3 control-label">Telephone</label>
          <div class="col-md-9">
            <input type="tel" class="form-control" required="required"
                   name="tel" title="">
          </div>
        </div>
        <div class="form-group">
          <label for="address" class="col-md-3 control-label">Address</label>
          <div class="col-md-9">
            <input type="text" class="form-control" required="required"
                   name="address" title="">
          </div>
        </div>
        <div class="form-group">
          <label for="password1" class="col-md-3 control-label">Password</label>
          <div class="col-md-9">
            <input type="password" class="form-control" required="required"
                   name="password1" title="">
          </div>
        </div>
        <div class="form-group">
          <label for="password2" class="col-md-3 control-label">
            Password Confirm
          </label>
          <div class="col-md-9">
            <input type="password" class="form-control" required="required"
                   name="password2" title="">
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-offset-3 col-md-9">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="privacy" required="required">
                I agree to the <a href="#">privacy policy</a>
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
<script src="js/bootstrap.js"></script>
<script src="js/confirmation.js"></script>
</body>
</html>
