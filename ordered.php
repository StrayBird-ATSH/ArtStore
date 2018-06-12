<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Art Store-ordered art works</title>
  <link href="css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="css/site_theme.css">
</head>
<body>
<?php
session_start();
if (isset($_COOKIE['footprint'])) {
  $_COOKIE['footprint'] .= ("ordered.php" . ",");
  $_COOKIE['title'] .= "Ordered Page,";
} else {
  setcookie('footprint', "ordered.php,");
  setcookie('title', "Ordered Page,");
}
require_once 'includes\config.php';
include 'art-header.inc.php';
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
$connection->query("SET NAMES utf8");
$error = mysqli_connect_error();
if ($error != null) {
  $output = "<p>Unable to connect to database<p>" . $error;
  exit($output);
} ?>
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-heading">Account</div>
        <div class="panel-body">
          <ul class="nav nav-pills nav-stacked">
            <li><a href="account.php">My Account</a></li>
            <li><a href="my_artworks.php">My art works</a></li>
            <li><a href="sold.php">Sold art works</a></li>
            <li class="active"><a href="ordered.php">Order history</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <h2>Ordered Art Works</h2>
      <?php
      if (!isset($_SESSION['email']))
        exit("<h1>Please login first.</h1>");
      $email = $_SESSION['email'];
      $sql = "SELECT orderID,title,artworkID,timeCreated,price FROM orders WHERE ownerEmail='$email'";
      $result = mysqli_query($connection, $sql);
      $list = mysqli_fetch_all($result, MYSQLI_ASSOC); ?>
      <table class="table table-condensed">
        <thead>
        <tr>
          <th>Order Number</th>
          <th>Product</th>
          <th>Price</th>
          <th>Date</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i = 0; $i < count($list); $i++) {
          $orderNumber = $list[$i]['orderID'];

          echo "<tr>";
          echo "<td>" . $list[$i]['orderID'] . "</td>";
          echo "<td><em><a href=\"details.php?artworkID=" .
              $list[$i]['artworkID'] . "\">" .
              $list[$i]['title'] . "</a></em></td>";
          echo "<td>$" . $list[$i]['price'] . "</td>";
          echo "<td>" . $list[$i]['timeCreated'] . "</td>";
          echo "</tr>";
        } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>  <!-- end container -->
<?php include 'art-footer.inc.php' ?>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/pagination.js"></script>
<script type="text/javascript" src="js/big_image.js"></script>
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