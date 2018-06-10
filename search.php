<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/site_theme.css">
  <title>Art Store-Search</title>
</head>
<body>
<?php
session_start();
include 'art-header.inc.php';
require_once 'includes\config.php';
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
$connection->query("SET NAMES utf8");
$error = mysqli_connect_error();
if ($error != null) {
  $output = "<p>Unable to connect to database<p>" . $error;
  exit($output);
}
$sql =
    "SELECT imageFileName,title,description,artist,artworkID,price,view FROM artworks";
if ((isset($_GET['title']) && $_GET['title'] != "") ||
    (isset($_GET['description']) && $_GET['description'] != "") ||
    (isset($_GET['artist']) && $_GET['artist'] != "")) {
  $sql .= " WHERE ";
  if ((isset($_GET['title']) && $_GET['title'] != "")) {
    $title = $_GET['title'];
    $sql .= " title LIKE  '$title'";
    if ((isset($_GET['description']) && $_GET['description'] != "")) {
      $description = $_GET['description'];
      $sql .= " AND description LIKE  '$description'";
      if ((isset($_GET['artist']) && $_GET['artist'] != "")) {
        $artist = $_GET['artist'];
        $sql .= " AND artist LIKE  '$artist'";
      }
    } elseif ((isset($_GET['artist']) && $_GET['artist'] != "")) {
      $artist = $_GET['artist'];
      $sql .= " AND artist LIKE  '$artist'";
    }
  } elseif ((isset($_GET['description']) && $_GET['description'] != "")) {
    $description = $_GET['description'];
    $sql .= " description LIKE  '$description'";
    if ((isset($_GET['artist']) && $_GET['artist'] != "")) {
      $artist = $_GET['artist'];
      $sql .= " AND artist LIKE '$artist'";
    }
  } elseif ((isset($_GET['artist']) && $_GET['artist'] != "")) {
    $artist = $_GET['artist'];
    $sql .= " artist LIKE  '$artist'";
  }
}
if (isset($_GET['sort']) && $_GET['sort'] != 0) {
  $sortValue = $_GET['sort'];
  $sql .= " ORDER BY ";
  if ($sortValue == "1")
    $sql .= " price ";
  else
    $sql .= " view DESC";
}
$result = mysqli_query($connection, $sql . " LIMIT 80");
$images = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<div class="container">
  <div class="row">
    <div class="col-md-10">
      <form method="get" action="search.php">
        <div id="searchBox">
          <input id="searchInput" type="search" name="title"
                 placeholder="Search titles"/>
          <input type="search" name="description"
                 placeholder="Search descriptions">
          <input type="search" name="artist"
                 placeholder="Search artist">
          <select name="sort" id="sort" title="">
            <option value="0">Sort the result</option>
            <option value="1">By Price</option>
            <option value="2">By View</option>
          </select>
          <input type="submit" class="btn btn-primary" value="Search"/>
        </div>
        <div id="artistBox">
          <table class="table table-bordered">
            <caption>Paintings</caption>
            <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">Title</th>
              <th scope="col">Artist</th>
              <th scope="col">Price</th>
              <th scope="col">View</th>
            </tr>
            </thead>
            <tbody>
            <?php
            for ($i = 0; $i < count($images); $i++) {
              echo "<tr>";
              echo "<td><img class=\"artThumb\" src=\"img/" .
                  $images[$i]['imageFileName'] . "\" alt = \"" .
                  str_replace('"', ' ', $images[$i]['description']) .
                  "\"/></td>";
              echo "<td><em><a href=\"details.php?artworkID=" .
                  $images[$i]['artworkID'] . "\">" .
                  $images[$i]['title'] . "</a></em></td>";
              echo "<td>" . $images[$i]['artist'] . "</td>";
              echo "<td>$" . $images[$i]['price'] . "</td>";
              echo "<td>" . $images[$i]['view'] . "</td>";
              echo "</tr>";
            }
            ?>
            </tbody>
          </table>
        </div>
      </form>
    </div>
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
    </div>
  </div>
</div>
<?php include 'art-footer.inc.php' ?>
<script src="js/jquery.js"></script>
<script src="js/pagination.js"></script>
<script type="text/javascript" src="js/big_image.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function ($) {
    $('.table tbody').pagination({
      perPage: 8,
      insertAfter: '.table',
      pageNumbers: true
    });
  });
</script>
</body>
</html>