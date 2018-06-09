<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/site_theme.css">
  <title>Art Store-Search</title>
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
$sqlView =
    "SELECT imageFileName,title,description,artworkID FROM artworks ORDER BY view DESC LIMIT 3";
$result = mysqli_query($connection, $sqlView);
$imagesViewMost = mysqli_fetch_all($result, MYSQLI_ASSOC);
$sqlRecent = "SELECT * FROM artworks ORDER BY timeReleased DESC LIMIT 3";
$result = mysqli_query($connection, $sqlRecent);
$imagesMostRecent = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<div class="container">
  <div class="row">
    <div class="col-md-10">
      <form method="get" action="http://www.randyconnolly.com/tests/process.php">
        <div id="searchBox">
          <input id="searchInput"
                 type="search" name="search" placeholder="Search titles"/>
          <input type="submit" class="btn btn-primary" value="Search"/>
        </div>
        <div id="settingsBox">
          <select title="" name="actions">
            <option value="0">Actions</option>
            <option value="1">Archive</option>
          </select>
          <input type="submit" class="btn btn-primary" value="Apply"/>
          <select title="" name="filter">
            <option value="0">Genre</option>
            <option value="1">Baroque</option>
            <option value="2">Mannerism</option>
            <option value="3">Neo-Classicism</option>
            <option value="4">Realism</option>
            <option value="5">Romanticism</option>
          </select>
          <input type="submit" class="btn btn-primary" value="Filter"/>
          <select title="" name="sort" id="sort-selection">
            <option value="0">Artists</option>
            <option value="1">Genre</option>
          </select>
          <input type="submit" class="btn btn-primary" value="Sort">
        </div>
        <div id="artistBox">
          <table class="table table-bordered">
            <caption>Paintings</caption>
            <thead>
            <tr>
              <th colspan="2"></th>
              <th scope="col">Title</th>
              <th scope="col">Artist</th>
              <th scope="col">Year</th>
              <th scope="col">Genre</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td><input title="checkbox" type="checkbox" name="index[]" value="10"/></td>
              <td><img class="artThumb" src="images/art/thumbs/05030.jpg" alt="Death of Marat"/></td>
              <td><em>Death of Marat</em></td>
              <td>David, Jacques-Louis</td>
              <td>1793</td>
              <td>Romanticism</td>
              <td>
                <button><a href="details.php"><img src="images/edit16.png" alt=""/> See</a></button>
              </td>
            </tr>
            <tr>
              <td><input title="checkbox" type="checkbox" name="index[]" value="20"/></td>
              <td><img class="artThumb" src="images/art/thumbs/120010.jpg" alt="Portrait of Eleanor of Toledo"/></td>
              <td><em>Portrait of Eleanor of Toledo</em></td>
              <td>Bronzino, Agnolo</td>
              <td>1545</td>
              <td>Mannerism</td>
              <td>
                <button><a href="details.php"><img src="images/edit16.png" alt=""/> See</a></button>
              </td>
            </tr>
            <tr>
              <td><input title="checkbox" type="checkbox" name="index[]" value="30"/></td>
              <td><img class="artThumb" src="images/art/thumbs/07020.jpg" alt="Liberty Leading the People"/></td>
              <td><em>Liberty Leading the People</em></td>
              <td>Delacroix, Eugene</td>
              <td>1830</td>
              <td>Romanticism</td>
              <td>
                <button><a href="details.php"><img src="images/edit16.png" alt=""/> See</a></button>
              </td>
            </tr>
            <tr>
              <td><input title="checkbox" type="checkbox" name="index[]" value="40"/></td>
              <td><img class="artThumb" src="images/art/thumbs/13030.jpg" alt="Arrangement in Grey and Black"/></td>
              <td><em>Arrangement in Grey and Black</em></td>
              <td>Whistler, James Abbott</td>
              <td>1871</td>
              <td>Realism</td>
              <td>
                <button><a href="details.php"><img src="images/edit16.png" alt=""/> See</a></button>
              </td>
            </tr>
            <tr id="selected_row">
              <td><input title="checkbox" type="checkbox" name="index[]" value="50"/></td>
              <td><img class="artThumb" src="images/art/thumbs/06010.jpg" alt="Mademoiselle Caroline Riviere"/></td>
              <td><em>Mademoiselle Caroline Riviere</em></td>
              <td>Ingres, Jean-Auguste</td>
              <td>1806</td>
              <td>Neo-Classicism</td>
              <td>
                <button><a href="details.php"><img src="images/edit16.png" alt=""/> See</a></button>
              </td>
            </tr>
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
      perPage: 3,
      insertAfter: '.table',
      pageNumbers: true
    });
  });
</script>
</body>
</html>