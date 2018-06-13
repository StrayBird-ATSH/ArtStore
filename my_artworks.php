<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Art Store-My art works</title>
  <link href="css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="css/site_theme.css">
</head>
<body>
<?php
session_start();
if (isset($_COOKIE['footprint'])) {
  setcookie('footprint', $_COOKIE['footprint'] . ("my_artworks.php" . ","));
  setcookie('title', $_COOKIE['title'] . "My Artworks Page,");
} else {
  setcookie('footprint', "my_artworks.php,");
  setcookie('title', "My Artworks Page,");
}
require_once 'includes\config.php';
include 'art-header.inc.php';
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
$connection->query("SET NAMES utf8");
$error = mysqli_connect_error();
if ($error != null) {
  $output = "<p>Unable to connect to database<p>" . $error;
  exit($output);
}
$status = '0';
if (isset($_GET['artworkID'])) {
  $artworkID = $_GET['artworkID'];
  $sql = "DELETE FROM artworks WHERE artworkID=$artworkID";
  $result = mysqli_query($connection, $sql);
  if ($result)
    $status = 'delete success';
  else $status = 'delete failed';
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
            <li class="active"><a href="my_artworks.php">My art works</a></li>
            <li><a href="sold.php">Sold art works</a></li>
            <li><a href="ordered.php">Order history</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <h2>My art works</h2>
      <?php
      if (!isset($_SESSION['email']))
        exit("<h1>Please login first.</h1>");
      $email = $_SESSION['email'];
      if ($status === 'delete success') {
        echo "<div class=\"alert alert-success alert-dismissible\" role=\"alert\">";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">";
        echo "<span aria-hidden=\"true\">&times;</span>";
        echo "</button>";
        echo "<strong>Success! </strong>";
        echo "You have successfully deleted!</div>";
      } elseif ($status === 'delete failed') {
        echo "<div class=\"alert alert-danger alert-dismissible\" role=\"alert\">";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">";
        echo "<span aria-hidden=\"true\">&times;</span>";
        echo "</button>";
        echo "<strong>Failed! </strong>";
        echo "Sorry, the delete is failed.</div>";
      } elseif (isset($_GET['delete'])) {
        $artworkID = $_GET['delete'];
        echo "<div class=\"alert alert-danger alert-dismissible\" role=\"alert\">";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">";
        echo "<span aria-hidden=\"true\">&times;</span>";
        echo "</button>";
        echo "<strong>Danger! </strong>";
        echo "Are you sure to delete this item?";
        echo "<a type=\"button\" class=\"btn btn-danger\" href='modify.php?artworkID=";
        echo $artworkID;
        echo "'>Delete</a></td>";
        echo "</div>";
      }
      $sql = "SELECT title,timeReleased,artworkID FROM artworks WHERE releaseUserEmail ='$email'";
      $result = mysqli_query($connection, $sql);
      $myArtworkList = mysqli_fetch_all($result, MYSQLI_ASSOC);
      ?>
      <table class="table table-condensed">
        <thead>
        <tr>
          <th>Artwork Name</th>
          <th>Date Released</th>
          <th>Action</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i = 0; $i < count($myArtworkList); $i++) {
          echo "<tr>";
          echo "<td><em><a href=\"details.php?artworkID=" .
              $myArtworkList[$i]['artworkID'] . "\">" .
              $myArtworkList[$i]['title'] . "</a></em></td>";
          echo "<td>" . $myArtworkList[$i]['timeReleased'] . "</td>";
          echo "<td><a type=\"button\" class=\"btn btn-info\" href='modify.php?artworkID=";
          echo $myArtworkList[$i]['artworkID'];
          echo "'>Edit</a></td>";
          echo "<td><a type=\"button\" class=\"btn btn-danger\" href='modify.php?delete=";
          echo $myArtworkList[$i]['artworkID'];
          echo "'>Remove</a></td>";
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
