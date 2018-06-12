<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Art Store-details</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/site_theme.css">
</head>
<body>
<?php
session_start();
$artworkID = 437;
if (isset($_GET['artworkID']))
  $artworkID = $_GET['artworkID'];
elseif (isset($_GET['add']))
  $artworkID = $_GET['add'];
if (isset($_COOKIE['footprint'])) {
  $_COOKIE['footprint'] .= ("details.php?artworkID=$artworkID" . ",");
  $_COOKIE['title'] .= "Details_Page,";
} else {
  setcookie('footprint', "details.php?artworkID=$artworkID,");
  setcookie('title', "Details_Page,");
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
$sql = "SELECT * FROM artworks WHERE artworkID=$artworkID";
$result = mysqli_query($connection, $sql);
$imagesInformation = mysqli_fetch_all($result, MYSQLI_ASSOC);
$view = $imagesInformation[0]['view'];
$releaseUserEmail = $imagesInformation[0]['releaseUserEmail'];
$imageFileName = $imagesInformation[0]['imageFileName'];
$title = $imagesInformation[0]['title'];
$description = $imagesInformation[0]['description'];
$title = str_replace("'", "\'", $title);
$description = str_replace("'", "\'", $description);
$price = $imagesInformation[0]['price'];
$view++;
$sql = "UPDATE artworks SET view = $view WHERE artworkID = $artworkID";
mysqli_query($connection, $sql);
$add_result = '0';
$saleStatus = '0';
if (isset($imagesInformation[0]['buyerEmail']))
  $saleStatus = '1';
if (isset($_SESSION['email']) && isset($_GET['add'])) {
  $email = $_SESSION['email'];
  $sql = "SELECT COUNT(*) FROM carts WHERE userEmail='$email' AND artworkID=$artworkID";
  $result = mysqli_query($connection, $sql);
  $row = $result->fetch_assoc();
  if ($row['COUNT(*)'] === '0') {
    $sql = "INSERT INTO carts (artworkID,title,description,price,imageFileName,userEmail,releaseUserEmail) 
          VALUES ($artworkID,'$title','$description',$price,'$imageFileName','$email','$releaseUserEmail')";
    if (mysqli_query($connection, $sql))
      $add_result = 'success';
    else $add_result = 'add failed';
  } else $add_result = 'already added';
} ?>
<div class="container">
  <div class="row">
    <div class="col-md-10">
      <h2><?php echo $imagesInformation[0]['title'] ?></h2>
      <p>By <?php echo $imagesInformation[0]['artist'] ?></p>
      <div class="row">
        <div class="col-md-5">
          <img src="img/<?php echo $imageFileName ?>"
               class="img-thumbnail img-responsive"/>
        </div>
        <div class="col-md-7">
          <p>
            <?php echo $imagesInformation[0]['description'] ?>
          </p>
          <p class="price">$<?php echo $price ?></p>
          <div class="btn-group btn-group-lg">
            <button type="button" class="btn btn-default">
              <a href="#"><span class="glyphicon glyphicon-gift">
                </span> Add to Wish List</a>
            </button>
            <?php
            if ($saleStatus === '0') {
              echo "<button type=\"button\" class=\"btn btn-default\">";
              echo "<a href=\"details.php?add=";
              echo $artworkID;
              echo "\">";
            } else {
              echo "<button type=\"button\" class=\"btn btn-warning\">";
              echo "<a>";
            }
            echo "<span class=\"glyphicon glyphicon-shopping-cart\">";
            echo "</span> Add to Shopping Cart</a>";
            echo "</button>";
            ?>
          </div>
          <p>&nbsp;</p>
          <?php
          if ($add_result === 'success') {
            echo "<div class=\"alert alert-success alert-dismissible\" role=\"alert\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">";
            echo "<span aria-hidden=\"true\">&times;</span>";
            echo "</button>";
            echo "<strong>Success! </strong>";
            echo "You have successfully added the item into shopping cart!</div>";
          } elseif ($add_result === 'add failed') {
            echo "<div class=\"alert alert-danger alert-dismissible\" role=\"alert\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">";
            echo "<span aria-hidden=\"true\">&times;</span>";
            echo "</button>";
            echo "<strong>Failed! </strong>";
            echo "Sorry, the add operation is failed.</div>";
          } elseif ($add_result === 'already added') {
            echo "<div class=\"alert alert-warning alert-dismissible\" role=\"alert\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">";
            echo "<span aria-hidden=\"true\">&times;</span>";
            echo "</button>";
            echo "<strong>Failed! </strong>";
            echo "Sorry, the item is already in your shopping cart.</div>";
          } ?>
          <div class="panel panel-default">
            <div class="panel-heading">Product Details</div>
            <table class="table">
              <tr>
                <th>Date:</th>
                <td><?php echo $imagesInformation[0]['yearOfWork'] ?></td>
              </tr>
              <tr>
                <th>Medium:</th>
                <td>Oil on canvas</td>
              </tr>
              <tr>
                <th>Dimensions:</th>
                <td>
                  <?php
                  $width = $imagesInformation[0]['width'];
                  $height = $imagesInformation[0]['height'];
                  echo $width . "cm x " . $height . 'cm ' ?>
                </td>
              </tr>
              <tr>
                <th>Home:</th>
                <td>
                  National Gallery, London
                </td>
              </tr>
              <tr>
                <th>Genres:</th>
                <td><?php echo $imagesInformation[0]['genre'] ?>
                </td>
              </tr>
              <tr>
                <th>View:</th>
                <td><?php echo $imagesInformation[0]['view'] ?>
                </td>
              </tr>
              <tr>
                <th>Subjects:</th>
                <td>People, Arts</td>
              </tr>
              <tr>
                <th>Status:</th>
                <td>
                  <?php
                  if ($saleStatus === '0') echo "On Sale";
                  else echo "Sold";
                  ?></td>
              </tr>
            </table>
          </div>
        </div>  <!-- end col-md-7 -->
      </div>  <!-- end row (product info) -->
      <p>&nbsp;</p>
      <h3>Similar Products </h3>
      <div class="row">
        <div class="col-md-3">
          <div class="thumbnail">
            <img src="images/art/thumbs/116010.jpg"
                 alt="..." class="img-thumbnail img-responsive">
            <div class="caption">
              <p class="similarTitle">
                <a href="details.php?artworkID=443">Artist Holding a Thistle</a></p>
              <a type="button" class="btn btn-primary btn-xs"
                 href="details.php?artworkID=443">
                <span class="glyphicon glyphicon-info-sign"></span>
                View
              </a>
              <button type="button" class="btn btn-success btn-xs">
                <span class="glyphicon glyphicon-gift"></span> Wish
              </button>
              <a type="button" class="btn btn-info btn-xs"
                 href="details.php?artworkID=443">
                <span class="glyphicon glyphicon-shopping-cart"></span>
                Cart
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="thumbnail">
            <img src="images/art/thumbs/120010l.jpg"
                 alt="..." class="img-thumbnail img-responsive">
            <div class="caption">
              <p class="similarTitle">
                <a href="details.php?artworkID=450">Portrait of Eleanor of Toledo</a></p>
              <a type="button" class="btn btn-primary btn-xs"
                 href="details.php?artworkID=450">
                <span class="glyphicon glyphicon-info-sign"></span>
                View
              </a>
              <button type="button" class="btn btn-success btn-xs">
                <span class="glyphicon glyphicon-gift"></span> Wish
              </button>
              <a type="button" class="btn btn-info btn-xs"
                 href="details.php?artworkID=450">
                <span class="glyphicon glyphicon-shopping-cart"></span>
                Cart
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="thumbnail">
            <img src="images/art/thumbs/107010.jpg" class="img-thumbnail img-responsive">
            <div class="caption">
              <p class="similarTitle">
                <a href="details.php?artworkID=428">Madame de Pompadour</a></p>
              <a type="button" class="btn btn-primary btn-xs"
                 href="details.php?artworkID=428">
                <span class="glyphicon glyphicon-info-sign"></span>
                View
              </a>
              <button type="button" class="btn btn-success btn-xs">
                <span class="glyphicon glyphicon-gift"></span> Wish
              </button>
              <a type="button" class="btn btn-info btn-xs"
                 href="details.php?artworkID=428">
                <span class="glyphicon glyphicon-shopping-cart"></span>
                Cart
              </a>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="thumbnail">
            <img src="images/art/thumbs/106020.jpg"
                 alt="..." class="img-thumbnail img-responsive">
            <div class="caption">
              <p class="similarTitle">
                <a href="details.php?artworkID=425">Girl with a Pearl Earring</a></p>
              <a type="button" class="btn btn-primary btn-xs"
                 href="details.php?artworkID=425">
                <span class="glyphicon glyphicon-info-sign"></span>
                View
              </a>
              <button type="button" class="btn btn-success btn-xs">
                <span class="glyphicon glyphicon-gift"></span> Wish
              </button>
              <a type="button" class="btn btn-info btn-xs"
                 href="details.php?artworkID=425">
                <span class="glyphicon glyphicon-shopping-cart"></span>
                Cart
              </a>
            </div>
          </div>
        </div>

      </div>  <!-- end similar products row -->
    </div>  <!-- end col-md-10 (main content) -->

    <div class="col-md-2">

      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Cart </h3>
        </div>
        <div class="panel-body">

          <div class="media">
            <a class="pull-left" href="#">
              <img class="media-object" src="images/art/tiny/116010.jpg" alt="..." width="32">
            </a>
            <div class="media-body">
              <p class="cartText"><a href="details.php?artworkID=443">Artist Holding a Thistle</a></p>
            </div>
          </div>
          <div class="media">
            <a class="pull-left" href="#">
              <img class="media-object" src="images/art/tiny/113010.jpg" alt="..." width="32">
            </a>
            <div class="media-body">
              <p class="cartText">
                <a href="details.php?artworkID=437">Self-portrait in a Straw Hat</a></p>
            </div>
          </div>
          <strong class="cartText">Subtotal: <span class="text-warning">$1200</span></strong>
          <div>
            <button type="button" class="btn btn-primary btn-xs">
              <span class="glyphicon glyphicon-info-sign"></span>
              Edit
            </button>
            <button type="button" class="btn btn-primary btn-xs">
              <span class="glyphicon glyphicon-arrow-right"></span>
              Checkout
            </button>
          </div>
        </div>
      </div>

      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">Popular Artists</h3>
        </div>
        <div class="panel-body">
          <ul class="nav nav-pills nav-stacked">
            <li><a href="#">Caravaggio</a></li>
            <li><a href="#">Cezanne</a></li>
            <li><a href="#">Matisse</a></li>
            <li><a href="#">Michelangelo</a></li>
            <li><a href="#">Picasso</a></li>
            <li><a href="#">Raphael</a></li>
            <li><a href="#">Van Gogh</a></li>
          </ul>
        </div>
      </div>

      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">Popular Genres</h3>
        </div>
        <div class="panel-body">
          <ul class="nav nav-pills nav-stacked">
            <li><a href="#">Baroque</a></li>
            <li><a href="#">Cubism</a></li>
            <li><a href="#">Impressionism</a></li>
            <li><a href="#">Renaissance</a></li>
          </ul>
        </div>
      </div>
    </div> <!-- end col-md-2 (right navigation) -->
  </div>  <!-- end main row -->
</div>  <!-- end container -->
<?php include 'art-footer.inc.php' ?>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
