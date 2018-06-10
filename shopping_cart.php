<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Art Stored-Shopping Cart</title>
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/site_theme.css" rel="stylesheet">
</head>
<body>
<div class="container">
  <div class="page-header">
    <?php
    session_start();
    require_once 'includes\config.php';
    include 'art-header.inc.php';
    if (!isset($_SESSION['email']))
      exit("<h1>Please login first.</h1>");
    ?>
    <h2>View Cart</h2>
    <table class="table table-condensed">
      <tr>
        <th>Image</th>
        <th>Product</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Amount</th>
      </tr>
      <tr>
        <td><img class="img-thumbnail" src="images/art/tiny/116010.jpg" alt="..."></td>
        <td>Artist Holding a Thistle</td>
        <td>2</td>
        <td>$500</td>
        <td>$1000</td>
      </tr>
      <tr>
        <td><img class="img-thumbnail" src="images/art/tiny/113010.jpg" alt="..."></td>
        <td>Self-portrait in a Straw Hat</td>
        <td>1</td>
        <td>$700</td>
        <td>$700</td>
      </tr>
      <tr class="success strong">
        <td colspan="4" class="moveRight">Subtotal</td>
        <td>$1700</td>
      </tr>
      <tr class="active strong">
        <td colspan="4" class="moveRight">Tax</td>
        <td>$170</td>
      </tr>
      <tr class="strong">
        <td colspan="4" class="moveRight">Shipping</td>
        <td>$100</td>
      </tr>
      <tr class="warning strong text-danger">
        <td colspan="4" class="moveRight">Grand Total</td>
        <td>$1970</td>
      </tr>
      <tr>
        <td colspan="4" class="moveRight">
          <button type="button" class="btn btn-primary">Continue Shopping</button>
        </td>
        <td>
          <button type="button" class="btn btn-success">Checkout</button>
        </td>
      </tr>
    </table>
  </div>
</div>
<?php include 'art-footer.inc.php' ?>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>