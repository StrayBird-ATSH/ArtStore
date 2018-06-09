<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Art Store-login</title>
  <link href="css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="css/site_theme.css">
</head>
<body>
<?php include 'includes\art-header.inc.php' ?>
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-heading">Account</div>
        <div class="panel-body">
          <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="login.php">Login</a></li>
            <li><a href="register.html">Register</a></li>
          
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <form role="form" class="form-horizontal" action="login_success_redirect.php"
            method="post">
        <div class="page-header">
          <h2>Log in</h2>
          <p>If you don't have an account with us, please register at the register page.</p>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Email</label>
          <div class="col-md-9">
            <input type="email" title="email" class="form-control" name="email" id="email"
                   required="required">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Password</label>
          <div class="col-md-9">
            <input type="password" title="password" class="form-control"
                   name="password1" id="login-password" required="required">
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-offset-3 col-md-9">
            <button type="submit" class="btn btn-primary">Log in
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>  <!-- end container -->
<?php include 'art-footer.inc.php' ?>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/confirmation.js"></script>
</body>
</html>