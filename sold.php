<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Art Store-Sold art works</title>
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
            <li><a href="my_artworks.php">My art works</a></li>
            <li class="active"><a href="sold.php">Sold art works</a></li>
            <li><a href="ordered_logged.php">Order history</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <h2>Sold Art Works</h2>
      <?php
      if (!isset($_SESSION['email']))
        exit("<h1>Please login first.</h1>");
      $email = $_SESSION['email'];
      $sql = "SELECT title,purchaseTime,artworkID,price,buyerEmail FROM artworks WHERE releaseUserEmail ='$email' AND buyerEmail IS NOT NULL ";
      $result = mysqli_query($connection, $sql);
      $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
      ?>
      <table class="table table-condensed">
        <thead>
        <tr>
          <th>Title</th>
          <th>Time Sold</th>
          <th>Price sold</th>
          <th>Buyer</th>
          <th>Email</th>
          <th>Telephone</th>
          <th>Address</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i = 0; $i < count($items); $i++) {
          $buyerEmail = $items[$i]['buyerEmail'];
          $sql = "SELECT name,tel,address FROM users WHERE email ='$buyerEmail'";
          $result = mysqli_query($connection, $sql);
          $buyerInformation = mysqli_fetch_all($result, MYSQLI_ASSOC);
          echo "<tr>";
          echo "<td><em><a href=\"details.php?artworkID=" .
              $items[$i]['artworkID'] . "\">" .
              $items[$i]['title'] . "</a></em></td>";
          echo "<td>" . $items[$i]['purchaseTime'] . "</td>";
          echo "<td>" . $items[$i]['price'] . "</td>";
          echo "<td>" . $buyerInformation[0]['name'] . "</td>";
          echo "<td>" . $buyerInformation[0]['tel'] . "</td>";
          echo "<td>" . $buyerInformation[0]['address'] . "</td>";
          echo "</tr>";
        }
        ?>
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