<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Art Store-selling art works</title>
  <link href="css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="css/site_theme.css">
</head>
<body>
<?php
session_start();
require_once 'includes\config.php';
include 'art-header.inc.php';
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
$connection->query("SET NAMES utf8");
$error = mysqli_connect_error();
if ($error != null) {
  $output = "<p>Unable to connect to database<p>" . $error;
  exit($output);
}
?>
<div class="container">
  <div class="row">
    <div class="col-md-3">

      <div class="panel panel-default">
        <div class="panel-heading">Account</div>
        <div class="panel-body">
          <ul class="nav nav-pills nav-stacked">
            <li><a href="account.php">My Account</a></li>
            <li class="active"><a href="selling.php">Selling art works</a></li>
            <li><a href="sold.php">Sold art works</a></li>
            <li><a href="ordered_logged.php">Order history</a></li>
          </ul>
        </div>
      </div>

    </div>
    <div class="col-md-9">
      <h2>Selling Art Works</h2>
      <?php
      if (!isset($_SESSION['email']))
        exit("<h1>Please login first.</h1>");
      $email = $_SESSION['email'];
      $sql = "SELECT name,balance FROM users WHERE email='$email'";
      $result = mysqli_query($connection, $sql);
      $userInformation = mysqli_fetch_all($result, MYSQLI_ASSOC);
      $name = $userInformation[0]['name'];
      $balance = $userInformation[0]['balance'];
      ?>
      <table class="table table-condensed">
        <thead>
        <tr>
          <th>Image</th>
          <th>Product</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Amount</th>
          <th>Date</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td><img class="img-thumbnail" src="images/art/tiny/116010.jpg" alt="..."></td>
          <td><a href="details.php">Artist Holding a Thistle</a></td>
          <td>2</td>
          <td>$500</td>
          <td>$1000</td>
          <td>March 18, 2018</td>
        </tr>
        <tr>
          <td><img class="img-thumbnail" src="images/art/tiny/113010.jpg" alt="..."></td>
          <td><a href="details.php">Self-portrait in a Straw Hat</a></td>
          <td>1</td>
          <td>$700</td>
          <td>$700</td>
          <td>March 18, 2018</td>
        </tr>
        </tbody>

      </table>
    </div>
  </div>
</div>  <!-- end container -->
<?php include 'art-footer.inc.php' ?>
<script src="js/jquery.js"></script>
<script src="js/pagination.js"></script>
<script type="text/javascript" src="js/big_image.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function ($) {
    $('.table tbody').pagination({
      perPage: 2,
      insertAfter: '.table',
      pageNumbers: true
    });
  });
</script>
</body>
</html>
