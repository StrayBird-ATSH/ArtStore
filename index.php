<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Art Store</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/index_style.css">
  <link rel="stylesheet" href="css/site_theme.css">
</head>
<body>
<?php include 'includes\art-header.inc.php';
require_once 'includes\config.php';
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
$connection->query("SET NAMES utf8");
$error = mysqli_connect_error();
if ($error != null) {
  $output = "<p>Unable to connect to database<p>" . $error;
  exit($output);
}
if (isset($_GET['artworkID']))
  $artworkID = $_GET['artworkID'];
$sqlView = "SELECT * FROM artworks ORDER BY view DESC LIMIT 3";
$result = mysqli_query($connection, $sqlView);
$imagesViewMost = mysqli_fetch_all($result, MYSQLI_ASSOC);
$sqlRecent = "SELECT * FROM artworks ORDER BY timeReleased DESC LIMIT 3";
$result = mysqli_query($connection, $sqlRecent);
$imagesMostRecent = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="img/<?php echo $imagesViewMost[0]['imageFileName'] ?>" alt="...">
      <div class="carousel-caption">
        <h3>Caption Text</h3>
      </div>
    </div>
    <div class="item">
      <img src="img/<?php echo $imagesViewMost[1]['imageFileName'] ?>" alt="...">
      <div class="carousel-caption">
        <h3>Caption Text</h3>
      </div>
    </div>
    <div class="item">
      <img src="img/<?php echo $imagesViewMost[2]['imageFileName'] ?>" alt="...">
      <div class="carousel-caption">
        <h3>Caption Text</h3>
      </div>
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div> <!-- Carousel -->

<div class="container">
  <div class="row" id="hot-display">
    <div class="col-md-4">
      <img src="images/art/113010.jpg">
      <h3><a href="details.php">Self-portrait in a Straw Hat</a></h3>
      <p>By <a href="search.php">Louise Elisabeth Lebrun</a></p>
      <p>The painting appears, after cleaning, to be an autograph replica of a picture, the
        original of which was painted in Brussels in 1782 in free imitation of Rubens's
        'Chapeau de Paille', which LeBrun had seen in Antwerp.</p>
    </div>
    <div class="col-md-4">
      <img src="images/art/113010.jpg">
      <h3><a href="details.php">Self-portrait in a Straw Hat</a></h3>
      <p>By <a href="search.php">Louise Elisabeth Lebrun</a></p>
      <p>The painting appears, after cleaning, to be an autograph replica of a picture, the
        original of which was painted in Brussels in 1782 in free imitation of Rubens's
        'Chapeau de Paille', which LeBrun had seen in Antwerp.</p>
    </div>
    <div class="col-md-4">
      <img src="images/art/113010.jpg">
      <h3><a href="details.php">Self-portrait in a Straw Hat</a></h3>
      <p>By <a href="search.php">Louise Elisabeth Lebrun</a></p>
      <p>The painting appears, after cleaning, to be an autograph replica of a picture, the
        original of which was painted in Brussels in 1782 in free imitation of Rubens's
        'Chapeau de Paille', which LeBrun had seen in Antwerp.</p>
    </div>
  </div>
</div>

<?php include 'art-footer.inc.php' ?>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
