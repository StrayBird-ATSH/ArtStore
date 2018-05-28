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
<?php include 'includes\art-header.inc.php' ?>
<section class="hero is-dark home-body">
  <div class="slider-bg">
    <div class="home-banner-slider " id="bg0"
         style="background-image:url('images/works/large/131010.jpg')"
         data-index="0"></div>
    <div class="home-banner-slider is-active" id="bg1"
         style="background-image:url('images/works/large/132030.jpg')"
         data-index="1"></div>
  </div>
  <div class="hero-body">
    <div class="hero-slider">
      <div class="slider-hero container slick-initialized slick-slider slick-dotted">
        <button onclick="changeImage()" class="slick-prev slick-arrow" type="button"
                style="display: block;">Previous
        </button>
        <!-- loop slider -->
        <div class="slick-list draggable" id="slick-list">
          <div class="slick-track" style="opacity: 1;">
            <div class="col-md-2">
              <section class="slick-slide" id="slick-slide00"
                       style="width: 30em; opacity: 0; transition: opacity 500ms ease-out;">
                <div class="columns is-vcentered">
                  <div class="column">
                    <p class="title">Landscape with a Calm</p>
                    <p class="subtitle">In the late 1640s and early 1650s, at the height of his
                      artistic <br>
                      maturity, Nicolas Poussin turned from historical narrative to landscape
                      painting. <br>
                      Landscape with a Calm does not illustrate a story but rather evokes a mood.
                    </p>
                    <a class="btn-more" href="details.php"></a>
                  </div>
                </div>
              </section>
            </div>
            <div class="col-md-5">
              <section class="slick-slide slick-current slick-active" id="slick-slide01"
                       style="width: 30em;  opacity: 1; transition: opacity 500ms ease-out;">
                <div class="columns is-vcentered">
                  <div class="column">
                    <p class="title">The Grand Canal in Venice</p>
                    <p class="subtitle">Canaletto was at the peak of his powers when he created this
                      view of the
                      sun-drenched palaces lining the Grand Canal and reflected in its shimmering
                      water.
                      With precise brushwork, he also evoked the effects of soot and crumbling
                      stucco disfiguring
                      the facades.</p>
                    <a class="btn-more" href="details.php"></a>
                  </div>
                </div>
              </section>
            </div>
          </div>
        </div>
        <!-- loop end -->
        <button onclick="changeImage()" class="slick-next slick-arrow" type="button" style="display: block;">
          Next
        </button>
      </div>
    </div>
  </div>
</section>

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

<?php include 'includes\art-footer.inc.php' ?>
<script src="js/jquery.js"></script>
<script src="js/homepage.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
