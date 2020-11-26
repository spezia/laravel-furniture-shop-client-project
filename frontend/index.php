<!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Konstantin Home</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">


  <link rel="shortcut icon" href="favicon.ico">

  <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/dist/css/jquery.fancybox.min.css">
  <link rel="stylesheet" href="assets/dist/css/index.min.css">


</head>

<body>

  <header>
    <div class="top-header">
      <div class="container-big">
        <div class="space-between">
          <div>Mail: info@konstantinhome.com |<br class="d-sm-none" /> Tel: +381 9841012345</div>
          <div>
            <a><img src="assets/dist/img/header-footer/instagram.png" alt="instagram" /></a>
            <a><img src="assets/dist/img/header-footer/fb.png" alt="facebook" /></a>
          </div>
        </div>
      </div>
    </div>

    <div class="container-big">
      <nav class="navbar navbar-expand-lg navbar-light ">
        <a class="navbar-brand" href="./">
          <img src="assets/dist/img/header-footer/logo.png" alt="logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto mx-auto">
            <li class="nav-item <?php if (!isset($_GET['page'])) { echo 'active'; } ?>">
              <a class="nav-link" href="./">Pocetna</a>
              <div class="active-line"></div>
            </li>
            <li class="nav-item <?php if (isset($_GET['page']) && $_GET['page'] == 'about') { echo 'active'; } ?>">
              <a class="nav-link" href="about">O nama</a>
            </li>
            <li class="nav-item has-dropdown <?php if (isset($_GET['page']) && $_GET['page'] == 'products') { echo 'active'; } ?>">
              <a class="nav-link" href="products">Proizvodi</a>

              <div class="categories-dropdown">
                <ul>
                  <li><a href="products">Naziv Kategorije</a></li>
                  <li><a href="products">Naziv Kategorije</a></li>
                  <li><a href="products">Naziv Kategorije</a></li>
                </ul>
              </div>
            </li>
            <li
              class="nav-item <?php if (isset($_GET['page']) && $_GET['page'] == 'impressions') { echo 'active'; } ?>">
              <a class="nav-link" href="impressions">Utisci kupaca</a>
            </li>
            <li class="nav-item <?php if (isset($_GET['page']) && $_GET['page'] == 'contact') { echo 'active'; } ?>">
              <a class="nav-link" href="contact">Kontakt</a>
            </li>

          </ul>
        </div>

        <div class="nar-right ml-auto">
          <a href="cart" class="shoping-cart">
            <img src="assets/dist/img/header-footer/cart.png" alt="shopping cart" />
            <label>3</label>
          </a>
          <div class="language">
            <div class="chosen-lang">
              <input type="text" name="selected-language" readonly="readonly" class="active-language" value="Srb" />
              <img src="assets/dist/img/home/arrow-black.png" />
            </div>
            <div class="language-list">
              <div class="language-option">Srb</div>
              <div class="language-option">Nem</div>
              <div class="language-option">Fra</div>
              <div class="language-option">Ita</div>
            </div>
          </div>
        </div>
      </nav>
    </div>

  </header>


  <?php
        if (isset($_GET['page'])) {
            if (!@include("pages/" . $_GET['page'] . ".php"))
                require_once("pages/notfound.php");
        } else {
            require_once("pages/home.php");
        }
        ?>

  <footer>
    <div class="container-big">
      <div class="space-between">
        <img class="footer-logo" src="assets/dist/img/header-footer/logo-footer.png" alt="footer logo" />

        <ul>
          <li><a href="about">O nama</a></li>
          <li><a href="products">Proizvodi</a></li>
          <li><a href="contact">Kontakt</a></li>
        </ul>

        <div class="scroll-btn"><img src="assets/dist/img/home/arrow-black.png" alt="" /></div>

      </div>
    </div>

    <div class="copyright">© 2020 Daralai website</div>
  </footer>



  <script src="assets/dist/js/jquery-3.3.1.min.js"></script>
  <script src="assets/dist/js/tether.min.js"></script>
  <script src="assets/dist/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="assets/dist/js/jquery.fancybox.min.js"></script>
  <script src="assets/dist/js/script.js"></script>

</body>

</html>