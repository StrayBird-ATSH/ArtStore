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
<?php require_once 'includes\config.php';
include 'includes\art-header.inc.php';
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
$connection->query("SET NAMES utf8");
$error = mysqli_connect_error();
if ($error != null) {
  $output = "<p>Unable to connect to database<p>" . $error;
  exit($output);
}
$artworkID = 437;
if (isset($_GET['artworkID']))
  $artworkID = $_GET['artworkID'];
$sql = "SELECT * FROM artworks WHERE artworkID=$artworkID";
$result = mysqli_query($connection, $sql);
$imagesInformation = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<div class="container">
  <div class="row">
    <div class="col-md-10">
      <h2><?php echo $imagesInformation[0]['title'] ?></h2>
      <p>By <?php echo $imagesInformation[0]['artist'] ?></p>
      <div class="row">
        <div class="col-md-5">
          <img src="img/<?php echo $imagesInformation[0]['imageFileName'] ?>"
               class="img-thumbnail img-responsive"/>
        </div>
        <div class="col-md-7">
          <p>
            <?php echo $imagesInformation[0]['description'] ?>
          </p>
          <p class="price">$<?php echo $imagesInformation[0]['price'] ?></p>
          <div class="btn-group btn-group-lg">
            <button type="button" class="btn btn-default">
              <a href="#"><span class="glyphicon glyphicon-gift"></span> Add to Wish List</a>
            </button>
            <button type="button" class="btn btn-default" onclick="alert('Add success')">
              <a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Add to Shopping Cart</a>
            </button>
          </div>
          <p>&nbsp;</p>
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
                <th>Subjects:</th>
                <td>People, Arts</td>
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
            <img src="images/art/thumbs/116010.jpg" alt="..." class="img-thumbnail img-responsive">
            <div class="caption">
              <p class="similarTitle"><a href="#">Artist Holding a Thistle</a></p>
              <!--Add CSS style to this place, Mar 9 1712-->
              <button type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-info-sign"></span>
                View
              </button>
              <button type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-gift"></span> Wish
              </button>
              <button type="button" class="btn btn-info btn-xs" onclick="alert('Add success')">
                <span class="glyphicon glyphicon-shopping-cart"></span>
                Cart
              </button>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="thumbnail">
            <img src="images/art/thumbs/120010l.jpg" alt="..." class="img-thumbnail img-responsive">
            <div class="caption">
              <p class="similarTitle"><a href="#">Portrait of Eleanor of Toledo</a></p>
              <button type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-info-sign"></span>
                View
              </button>
              <button type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-gift"></span> Wish
              </button>
              <button type="button" class="btn btn-info btn-xs" onclick="alert('Add success')">
                <span class="glyphicon glyphicon-shopping-cart"></span>
                Cart
              </button>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="thumbnail">
            <img src="images/art/thumbs/107010.jpg" alt="..." class="img-thumbnail img-responsive">
            <div class="caption">
              <p class="similarTitle"><a href="#">Madame de Pompadour</a></p>
              <button type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-info-sign"></span>
                View
              </button>
              <button type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-gift"></span> Wish
              </button>
              <button type="button" class="btn btn-info btn-xs" onclick="alert('Add success')">
                <span class="glyphicon glyphicon-shopping-cart"></span>
                Cart
              </button>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="thumbnail">
            <img src="images/art/thumbs/106020.jpg" alt="..." class="img-thumbnail img-responsive">
            <div class="caption">
              <p class="similarTitle"><a href="#">Girl with a Pearl Earring</a></p>
              <button type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-info-sign"></span>
                View
              </button>
              <button type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-gift"></span> Wish
              </button>
              <button type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-shopping-cart"></span>
                Cart
              </button>
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
              <p class="cartText"><a href="#">Artist Holding a Thistle</a></p>
            </div>
          </div>
          <div class="media">
            <a class="pull-left" href="#">
              <img class="media-object" src="images/art/tiny/113010.jpg" alt="..." width="32">
            </a>
            <div class="media-body">
              <p class="cartText"><a href="#">Self-portrait in a Straw Hat</a></p>
            </div>
          </div>
          <strong class="cartText">Subtotal: <span class="text-warning">$1200</span></strong>
          <div>
            <button type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-info-sign"></span>
              Edit
            </button>
            <button type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-arrow-right"></span>
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
