<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Art Store-Modify page</title>
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/site_theme.css" rel="stylesheet">
</head>
<body>
<?php
session_start();
if (isset($_GET['artworkID'])) {
  $artworkID = $_GET['artworkID'];
  if (isset($_COOKIE['footprint'])) {
    setcookie('footprint', $_COOKIE['footprint'] . ("modify.php?artworkID=$artworkID" . ","));
    setcookie('title',  $_COOKIE['title'] . "Modify Page,");
  } else {
    setcookie('footprint', "modify.php?artworkID=$artworkID,");
    setcookie('title', "Modify Page,");
  }
}
include 'art-header.inc.php';
$status = '0';
require_once 'includes\config.php';
$connection = mysqli_connect(
    DBHOST, DBUSER, DBPASS, DBNAME);
$connection->query("SET NAMES utf8");
$error = mysqli_connect_error();
if ($error != null) {
  $output = "<p>Unable to connect to database<p>" . $error;
  exit($output);
}
if (isset($_GET['artworkID'])) {
  $status = true;
  $artworkID = $_GET['artworkID'];
  $sql = "SELECT title,artist,description,yearOfWork,genre,
width,height,price,imageFileName FROM artworks 
WHERE artworkID=$artworkID";
  $result = mysqli_query($connection, $sql);
  $artworkInfo = mysqli_fetch_all($result, MYSQLI_ASSOC);
} elseif ($_SERVER['REQUEST_METHOD'] === "POST") {
  $artworkID = $_POST['artworkID'];
  $title = $_POST['title'];
  $title = str_replace("'", "\'", $title);
  $author = $_POST['author'];
  $author = str_replace("'", "\'", $author);
  $description = $_POST['description'];
  $description = str_replace("'", "\'", $description);
  $year = $_POST['year'];
  $genre = $_POST['genre'];
  $width = $_POST['width'];
  $height = $_POST['height'];
  $price = $_POST['price'];
  $fileName = time() . ".jpg";
  if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $sql = "UPDATE artworks SET title='$title',artist='$author',
description='$description',yearOfWork=$year,genre='$genre',
width = $width,height=$height,price=$price,imageFileName='$fileName'
 WHERE artworkID = $artworkID";
    $fileToMove = $_FILES['image']['tmp_name'];
    $destination = "./img/" . $fileName;
    echo $email;
    echo $sql;
    echo $fileToMove;
    echo $destination;
    if (mysqli_query($connection, $sql)) {
      $status = 'database update success';
      if (move_uploaded_file($fileToMove, $destination))
        $status = 'success';
    } else $status = 'modify failed';
  }
} ?>
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-heading">Manage your artworks</div>
        <div class="panel-body">
          <ul class="nav nav-pills nav-stacked">
            <li>
              <a href="release.php">Release</a>
            </li">
            <li class="active"><a href="modify.php">Modify</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <?php
      if ($status === 'success') {
        echo "<div class=\"alert alert-success alert-dismissible\" role=\"alert\">";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">";
        echo "<span aria-hidden=\"true\">&times;</span>";
        echo "</button>";
        echo "<strong>Success! </strong>";
        echo "You have successfully modified!</div>";
      } elseif ($status === 'database update success') {
        echo "<div class=\"alert alert-warning alert-dismissible\" role=\"alert\">";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">";
        echo "<span aria-hidden=\"true\">&times;</span>";
        echo "</button>";
        echo "<strong>Partially failed</strong>";
        echo "The database update is successful but the image update failed.</div>";
      } elseif ($status === 'modify failed') {
        echo "<div class=\"alert alert-danger alert-dismissible\" role=\"alert\">";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">";
        echo "<span aria-hidden=\"true\">&times;</span>";
        echo "</button>";
        echo "<strong>Failed! </strong>";
        echo "Sorry, the release is failed.</div>";
      } ?>
      <form role="form" class="form-horizontal" enctype="multipart/form-data"
            action="modify.php" method="post">
        <div class="page-header">
          <h2>Modify an artwork</h2>
          <?php
          if (!isset($_SESSION['email']))
            exit("<h1>Please login first.</h1>");
          if (!isset($_GET['artworkID']) && !isset($_POST['artworkID']))
            exit("<h1>Cannot be accessed directly.</h1>");
          ?>
          <p>You can modify your own artworks here.</p>
        </div>
        <div class="form-group">
          <label for="title" class="col-md-2 control-label">Artwork Title </label>
          <div class="col-md-9">
            <input type="text" class="form-control" required="required"
                   name="title" title=""
                   value=
                   "<?php if ($status) echo $artworkInfo[0]['title'] ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="author" class="col-md-2 control-label">Author</label>
          <div class="col-md-9">
            <input type="text" class="form-control" required="required"
                   name="author" title=""
                   value="<?php if ($status)
                     echo $artworkInfo[0]['artist'] ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="description" class="col-md-2 control-label">Description</label>
          <div class="col-md-9">
            <input type="text" class="form-control" required="required"
                   name="description" title=""
                   value="<?php if ($status) echo $artworkInfo[0]['description'] ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="year" class="col-md-2 control-label">Year</label>
          <div class="col-md-9">
            <input type="number" class="form-control" required="required"
                   name="year" title="" min="0" max="2018"
                   value="<?php if ($status) echo $artworkInfo[0]['yearOfWork'] ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="genre" class="col-md-2 control-label">Genre</label>
          <div class="col-md-9">
            <input type="text" class="form-control" required="required"
                   name="genre" title=""
                   value="<?php if ($status) echo $artworkInfo[0]['genre'] ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="width" class="col-md-2 control-label">Width</label>
          <div class="col-md-9">
            <input type="number" class="form-control" required="required"
                   name="width" title="" min="1" max="1000"
                   value="<?php if ($status) echo $artworkInfo[0]['width'] ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="height" class="col-md-2 control-label">
            Height
          </label>
          <div class="col-md-9">
            <input type="number" class="form-control" required="required"
                   name="height" title="" min="1" max="1000"
                   value="<?php if ($status) echo $artworkInfo[0]['height'] ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="price" class="col-md-2 control-label">
            Price
          </label>
          <div class="col-md-9">
            <input type="number" class="form-control" required="required"
                   name="price" title="" min="1" max="1000"
                   value="<?php if ($status) echo $artworkInfo[0]['price'] ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="image" class="col-md-2 control-label">
            Image File
          </label>
          <div class="col-md-9">
            <input type="file" class="form-control" required="required"
                   name="image" title="" id="upload" onchange="imagePreview()">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-2 control-label">
            Image Preview
          </label>
          <div class="col-sm-12 col-md-9">
            <div class="thumbnail">
              <img id="preview"
                   src="img/<?php if ($status) echo $artworkInfo[0]['imageFileName'] ?>">
            </div>
          </div>
        </div>
        <input type="hidden" name="artworkID"
               value="<?php if ($status) echo $artworkID ?>">
        <div class="form-group">
          <div class="col-md-offset-3 col-md-9">
            <button type="submit" class="btn btn-success">Modify</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php include 'art-footer.inc.php' ?>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/confirmation.js"></script>
</body>
</html>