<header>
  <div id="topHeaderRow">
    <div class="container">
      <nav class="navbar navbar-inverse " role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle"
                  data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <p class="navbar-text">Welcome to <strong>Art Store</strong>,
            <?php
            require_once 'includes\config.php';
            $sessionStatus = false;
            if (!isset($_SESSION['email'])) {
              echo "<a href=\"login.php\" class=\"navbar-link\">Login</a> or ";
              echo "<a href=\"register_page.php\" class=\"navbar-link\">";
              echo " Create new account</a>";
            } else {
              $sessionStatus = true;
              echo "Welcome " . $_SESSION['email'];
              echo " <a href=\"index.php?logOut=true\">Log out</a>";
            }
            ?>
          </p>
        </div>
        <?php if ($sessionStatus === true) { ?>
          <div class="collapse navbar-collapse navbar-ex1-collapse pull-right">
            <ul class="nav navbar-nav">
              <li><a href="account.php">
                <span class="glyphicon glyphicon-user">
                </span> My Account</a>
              </li>
              <li><a href="release.php">
                <span class="glyphicon glyphicon-gift">
                </span> Release </a>
              </li>
              <li><a href="shopping_cart.php">
                <span class="glyphicon glyphicon-shopping-cart">
                </span> Shopping Cart</a>
              </li>
              <li><a href="shopping_cart.php">
                <span class="glyphicon glyphicon-arrow-right">
                </span> Checkout</a>
              </li>
            </ul>
          </div>
        <?php } ?>
      </nav>
    </div>
  </div>
  <div id="logoRow">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <h1>Art Store</h1>
        </div>
        <div class="col-md-4">
          <form class="form-inline" role="search">
            <div class="input-group">
              <label class="sr-only" for="search">Search</label>
              <input type="text" class="form-control"
                     placeholder="Search for an artwork" name="title">
              <span class="input-group-btn">
                  <button class="btn btn-default" type="submit">
                    <span class="glyphicon glyphicon-search">
                    </span>
                  </button>
                  </span>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div id="mainNavigationRow">
    <div class="container">
      <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle"
                  data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="details.php">Art Works</a></li>
            <li><a href="search.php">Artists</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle"
                 data-toggle="dropdown">Specials <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="details.php?artworkID=29">Three Musicians</a></li>
                <li><a href="details.php?artworkID=44">Impression Sunrise</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>
</header>