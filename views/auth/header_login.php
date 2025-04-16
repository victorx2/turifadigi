<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Meta tags básicos -->
  <meta charset="UTF-8" />
  <meta name="author" content="TuRifadigi"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"> -->

  <meta name="description" content="TuRifadigi" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

  <!-- Título y Favicons -->
  <title>TuRifadigi</title>
  <!-- Rendered size:	1280 × 980 px
Rendered aspect ratio:	64∶49
File size:	41.7 kB
Current source:	https://cegarifas.site/assets/imgs/bb51b8b776.jpg
 -->
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $_ENV['APP_URL'] . $_ENV['BASE_PATH']; ?>/assets/img/favicons/apple-touch-icon.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $_ENV['APP_URL'] . $_ENV['BASE_PATH']; ?>/assets/img/favicons/favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $_ENV['APP_URL'] . $_ENV['BASE_PATH']; ?>/assets/img/favicons/favicon-16x16.png" />
  <link rel="manifest" href="<?php echo $_ENV['APP_URL'] . $_ENV['BASE_PATH']; ?>/assets/img/favicons/site.webmanifest" type="application/manifest+json" />

  <!-- Fuentes -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">

  <!-- CSS Frameworks -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <!-- jQuery UI -->
  <link href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" rel="stylesheet">

  <!-- <link rel="stylesheet" href="<?php echo $_ENV['APP_URL'] . $_ENV['BASE_PATH']; ?>/vendor/jquery-ui/jquery-ui.css" /> -->

  <!-- Swiper -->
  <link href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" rel="stylesheet">

  <!-- Plugins CSS -->

  <link rel="stylesheet" href="<?php echo $_ENV['APP_URL'] . $_ENV['BASE_PATH']; ?>/vendor/animate/animate.min.css" />
  <link rel="stylesheet" href="<?php echo $_ENV['APP_URL'] . $_ENV['BASE_PATH']; ?>/vendor/animate/custom-animate.css" />
  <link rel="stylesheet" href="<?php echo $_ENV['APP_URL'] . $_ENV['BASE_PATH']; ?>/vendor/jarallax/jarallax.css" />
  <link rel="stylesheet" href="<?php echo $_ENV['APP_URL'] . $_ENV['BASE_PATH']; ?>/vendor/jquery-magnific-popup/jquery.magnific-popup.css" />
  <link rel="stylesheet" href="<?php echo $_ENV['APP_URL'] . $_ENV['BASE_PATH']; ?>/vendor/odometer/odometer.min.css" />
  <link rel="stylesheet" href="<?php echo $_ENV['APP_URL'] . $_ENV['BASE_PATH']; ?>/vendor/owl-carousel/owl.carousel.min.css" />
  <link rel="stylesheet" href="<?php echo $_ENV['APP_URL'] . $_ENV['BASE_PATH']; ?>/vendor/owl-carousel/owl.theme.default.min.css" />
  <link rel="stylesheet" href="<?php echo $_ENV['APP_URL'] . $_ENV['BASE_PATH']; ?>/vendor/bootstrap-select/css/bootstrap-select.min.css" />
  <link rel="stylesheet" href="<?php echo $_ENV['APP_URL'] . $_ENV['BASE_PATH']; ?>/vendor/nice-select/nice-select.css" />

  <!-- CSS Personalizados -->
  <link rel="stylesheet" href="<?php echo $_ENV['APP_URL'] . $_ENV['BASE_PATH']; ?>/vendor/zefxa-icons/style.css">
  <link rel="stylesheet" href="<?php echo $_ENV['APP_URL'] . $_ENV['BASE_PATH']; ?>/vendor/reey-font/stylesheet.css" />
  <link rel="stylesheet" href="<?php echo $_ENV['APP_URL'] . $_ENV['BASE_PATH']; ?>/assets/css/custom.css" />
  <link rel="stylesheet" href="<?php echo $_ENV['APP_URL'] . $_ENV['BASE_PATH']; ?>/assets/css/custom_responsive.css" />
</head>

<body class="custom-cursor">

  <div class="custom-cursor__cursor"></div>
  <div class="custom-cursor__cursor-two"></div>

  <div class="preloader">
    <div class="preloader__image"></div>
  </div>
  <!-- /.preloader -->

  <div class="page-wrapper">
    <header class="main-header">
      <div class="main-menu__top">
        <div class="container">
          <div class="main-menu__top-inner">
            <div class="main-menu__top-left">
              <div class="main-menu__social">
                <a href="#"><i class="icon-facebook"></i></a>
                <a href="#"><i class="icon-google-plus-logo"></i></a>
                <a href="#"><i class="icon-twitter"></i></a>
              </div>
              <ul class="list-unstyled main-menu__contact-list">
                <li>
                  <div class="icon">
                    <i class="icon-phone-call"></i>
                  </div>
                  <div class="text">
                    <p><a href="tel:0012346823705">+00 (1234) 682 3705</a>
                    </p>
                  </div>
                </li>
                <li>
                  <div class="icon">
                    <i class="icon-mail"></i>
                  </div>
                  <div class="text">
                    <p><a href="mailto:needhelp@company.com">needhelp@company.com</a>
                    </p>
                  </div>
                </li>
                <li>
                  <div class="icon">
                    <i class="icon-maps-and-flags"></i>
                  </div>
                  <div class="text">
                    <p>80 Broklyn Golden Street UK</p>
                  </div>
                </li>
              </ul>
            </div>
            <div class="main-menu__top-right">
              <p class="main-menu__top-text">We Provide High Quality & Cost Effective Services</p>
            </div>
          </div>
        </div>
      </div>
      <nav class="main-menu">
        <div class="main-menu__wrapper">
          <div class="container">
            <div class="main-menu__wrapper-inner">
              <div class="main-menu__left">
                <div class="main-menu__logo">
                  <a href=""><img src="assets/img/resources/logo-1.png" alt=""></a>
                </div>
                <div class="main-menu__main-menu-box">
                  <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                </div>
              </div>
              <div class="main-menu__right">
                <div class="main-menu__cart-search-box">
                  <a href="#" class="main-menu__search search-toggler icon-magnifying-glass"></a>
                  <a href="#" class="main-menu__cart"><span class="icon-shopping-cart"></span></a>
                </div>
                <div class="main-menu__btn-box">
                  <a href="contact.html" class="main-menu__btn thm-btn">Get Free Quote</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </header>

    <div class="stricky-header stricked-menu main-menu">
      <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
    </div><!-- /.stricky-header -->

    <!--Page Header Start-->
    <section class="page-header">
      <div class="page-header__bg" style="background-image: url(assets/img/backgrounds/page-header-bg.jpg);">
      </div>
      <div class="page-header__shape-bg"
        style="background-image: url(assets/img/shapes/page-header-shape-bg-three.png);"></div>
      <div class="page-header__shape-1 float-bob-y">
        <img src="assets/img/shapes/page-header-shape-1.png" alt="">
      </div>
      <div class="page-header__shape-2 img-bounce">
        <img src="assets/img/shapes/page-header-shape-2.png" alt="">
      </div>
      <div class="page-header__shape-3 float-bob-x">
        <img src="assets/img/shapes/page-header-shape-3.png" alt="">
      </div>
      <div class="container">
        <div class="page-header__inner">
          <div class="thm-breadcrumb__box">
            <div class="thm-breadcrumb__icon">
              <img src="assets/img/shapes/section-title-tagline-shape.png" alt="">
            </div>
            <ul class="thm-breadcrumb list-unstyled">
              <li><a href="">Home</a></li>
              <li><span>-</span></li>
              <li>Contact Us</li>
            </ul>
          </div>
          <h2>Contact Us</h2>
        </div>
      </div>
    </section>
    <!--Page Header End-->