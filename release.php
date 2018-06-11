<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Art Store-Release page</title>
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/site_theme.css" rel="stylesheet">
</head>
<body>
<?php
session_start();
include 'art-header.inc.php';
$status = '0';
if (isset($_POST['title'])) {
  require_once 'includes\config.php';
  $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
  $connection->query("SET NAMES utf8");
  $error = mysqli_connect_error();
  if ($error != null) {
    $output = "<p>Unable to connect to database<p>" . $error;
    exit($output);
  }
  $title = $_POST['title'];
  $author = $_POST['author'];
  $description = $_POST['description'];
  $year = $_POST['year'];
  $genre = $_POST['genre'];
  $width = $_POST['width'];
  $height = $_POST['height'];
  $price = $_POST['price'];
  $fileName = time() . ".jpg";
  if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $sql = "INSERT INTO artworks (title, artist, description, yearOfWork,genre,width,height,price,releaseUserEmail,imageFileName) 
                      VALUES ('$title','$author','$description',$year,'$genre',$width,$height,$price,'$email','$fileName')";
    echo print_r($_FILES);
    $fileToMove = $_FILES['upload']['tmp_name'];
    $destination = "./img/" . $fileName;
    if (mysqli_query($connection, $sql))
      echo "connect OK";
    if (move_uploaded_file($fileToMove, $destination))
      $status = 'success';
    else $status = 'publish failed';
  }
} ?>
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-heading">Manage your artworks</div>
        <div class="panel-body">
          <ul class="nav nav-pills nav-stacked">
            <li class="active">
              <a href="release.php">Release</a>
            </li>
            <li><a href="modify.php">Modify</a></li>
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
        echo "You have successfully released!</div>";
      } elseif ($status === 'publish failed') {
        echo "<div class=\"alert alert-danger alert-dismissible\" role=\"alert\">";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">";
        echo "<span aria-hidden=\"true\">&times;</span>";
        echo "</button>";
        echo "<strong>Failed! </strong>";
        echo "Sorry, the release is failed.</div>";
      } ?>
      <form role="form" class="form-horizontal" enctype="multipart/form-data"
            action="release.php" method="post">
        <div class="page-header">
          <h2>Release an artwork</h2>
          <?php
          if (!isset($_SESSION['email']))
            exit("<h1>Please login first.</h1>");
          ?>
          <p>You can release your own artworks here.</p>
        </div>
        <div class="form-group">
          <label for="title" class="col-md-2 control-label">Artwork Title </label>
          <div class="col-md-9">
            <input type="text" class="form-control" required="required"
                   name="title" title="">
          </div>
        </div>
        <div class="form-group">
          <label for="author" class="col-md-2 control-label">Author</label>
          <div class="col-md-9">
            <input type="text" class="form-control" required="required"
                   name="author" title="">
          </div>
        </div>
        <div class="form-group">
          <label for="description" class="col-md-2 control-label">Description</label>
          <div class="col-md-9">
            <input type="text" class="form-control" required="required"
                   name="description" title="">
          </div>
        </div>
        <div class="form-group">
          <label for="year" class="col-md-2 control-label">Year</label>
          <div class="col-md-9">
            <input type="number" class="form-control" required="required"
                   min="0" max="2018" name="year" title="">
          </div>
        </div>
        <div class="form-group">
          <label for="genre" class="col-md-2 control-label">Genre</label>
          <div class="col-md-9">
            <input type="text" class="form-control" required="required"
                   name="genre" title="">
          </div>
        </div>
        <div class="form-group">
          <label for="width" class="col-md-2 control-label">Width</label>
          <div class="col-md-9">
            <input type="number" class="form-control" required="required"
                   min="1" max="1000" name="width" title="">
          </div>
        </div>
        <div class="form-group">
          <label for="height" class="col-md-2 control-label">
            Height
          </label>
          <div class="col-md-9">
            <input type="number" class="form-control" required="required"
                   min="1" max="1000" name="height" title="">
          </div>
        </div>
        <div class="form-group">
          <label for="price" class="col-md-2 control-label">
            Price
          </label>
          <div class="col-md-9">
            <input type="number" class="form-control" required="required"
                   min="1" max="10000" name="price" title="">
          </div>
        </div>
        <div class="form-group">
          <label for="image" class="col-md-2 control-label">
            Image File
          </label>
          <div class="col-md-9">
            <input type="file" class="form-control" required="required"
                   name="upload" title="" id="upload" onchange="imagePreview()">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-2 control-label">
            Image Preview
          </label>
          <div class="col-sm-12 col-md-9">
            <div class="thumbnail">
              <img id="preview" src="#" alt="Please choose an image.">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-offset-3 col-md-9">
            <button type="submit" class="btn btn-success">Release</button>
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