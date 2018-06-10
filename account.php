<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Art Store-account</title>
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
            <li class="active"><a href="account.php">My Account</a></li>
            <li><a href="selling.php">Selling art works</a></li>
            <li><a href="sold.php">Sold art works</a></li>
            <li><a href="ordered_logged.php">Order history</a></li>
          </ul>
        </div>
      </div>

    </div>
    <div class="col-md-9">
      <div class="page-header">
        <h2>My Account</h2>
        <p>Welcome .</p>
      </div>
      <div class="form-group">
        <label class="col-lg-2 control-label">Email</label>
        <div class="col-lg-10">
          <p class="form-control-static">email@example.com</p>
        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-2 control-label">First Name</label>
        <div class="col-lg-10">
          <p class="form-control-static">Chen</p>
        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-2 control-label">Last Name</label>
        <div class="col-lg-10">
          <p class="form-control-static">Wang</p>
        </div>
      </div>
      <form action="#">
        <input title="Top up amount" required="required" type="number" placeholder="The amount of top up">
        <button type="submit" class="btn btn-primary" onclick="alert('Top up success')"> Top Up</button>
      </form>
    </div>
  </div>
</div>  <!-- end container -->
<?php include 'art-footer.inc.php' ?>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
