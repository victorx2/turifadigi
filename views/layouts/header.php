<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title> TuRifaDigi </title>
  <!-- favicons Icons -->
  <link rel="apple-touch-icon" sizes="180x180" href="assets/img/backgrounds/TuRifaDigi.jpg" />
  <link rel="icon" type="image/png" sizes="32x32" href="assets/img/backgrounds/TuRifaDigi.jpg" />
  <link rel="icon" type="image/png" sizes="16x16" href="assets/img/backgrounds/TuRifaDigi.jpg" />
  <link rel="manifest" href="assets/img/favicons/site.webmanifest" />
  <meta name="description" content="zefxa HTML 5 Template " />
  <!-- fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
  <!-- Lista de boletos -->

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script>
    if (typeof bootstrap === 'undefined') {
      document.write('<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">')
    }
  </script>

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <script>
    if (typeof FontAwesome === 'undefined') {
      document.write('<link rel="stylesheet" href="vendor/fontawesome/css/all.min.css">')
    }
  </script>

  <!-- jQuery UI -->
  <link href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" rel="stylesheet">

  <!-- Swiper -->
  <link href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" rel="stylesheet">
  <script>
    if (typeof Swiper === 'undefined') {
      document.write('<link rel="stylesheet" href="vendor/swiper/swiper.min.css">')
    }
  </script>

  <!-- Recursos locales personalizados -->
  <link rel="stylesheet" href="vendor/animate/animate.min.css" />
  <link rel="stylesheet" href="vendor/animate/custom-animate.css" />
  <link rel="stylesheet" href="vendor/jarallax/jarallax.css" />
  <link rel="stylesheet" href="vendor/jquery-magnific-popup/jquery.magnific-popup.css" />
  <link rel="stylesheet" href="vendor/odometer/odometer.min.css" />
  <link rel="stylesheet" href="vendor/zefxa-icons/style.css">
  <link rel="stylesheet" href="vendor/owl-carousel/owl.carousel.min.css" />
  <link rel="stylesheet" href="vendor/owl-carousel/owl.theme.default.min.css" />
  <link rel="stylesheet" href="vendor/bootstrap-select/css/bootstrap-select.min.css" />
  <link rel="stylesheet" href="vendor/nice-select/nice-select.css" />
  <link rel="stylesheet" href="vendor/reey-font/stylesheet.css" />

  <!-- template styles -->
  <link rel="stylesheet" href="assets/css/custom.css" />
  <link rel="stylesheet" href="assets/css/custom_responsive.css" />

  <link rel="stylesheet" href="assets/css/dropdown-search.css">
</head>

<body class="custom-cursor">

  <div class="custom-cursor__cursor"></div>
  <div class="custom-cursor__cursor-two"></div>


  <!--  <div class="preloader">
    <div class="preloader__image"></div>
  </div> -->


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
        <div class="main-menu__wrapper" style="background-color: #201f23;">
          <div class="container">
            <div class="main-menu__wrapper-inner">
              <div class="main-menu__left">
                <div class="main-menu__logo">
                </div>
                <div class="main-menu__main-menu-box">
                  <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                  <ul class="main-menu__list">
                    <li class="dropdown">
                      <a href="/TuRifadigi/">Inicio
                        <span class="main-menu-border"></span>
                      </a>
                      <ul>
                        <li>
                          <a href="/TuRifadigi/rifa_config">El lado del admin</a>
                        </li>
                        <li class="dropdown">
                          <a href="/TuRifadigi/boletos">Vista de boletos</a>
                        </li>
                        <li class="dropdown">
                          <a href="/TuRifadigi/main_config">Editar el main</a>
                        </li>
                      </ul>
                    </li>
                    <li class="dropdown">
                      <a href="#">Cuentas de pago
                        <span class="main-menu-border"></span>
                      </a>
                      <ul>
                        <li><a href="">Cuentas de pago</a></li>
                      </ul>
                    </li>
                    <li class="dropdown">
                      <a href="#">Contacto
                        <span class="main-menu-border"></span>
                      </a>
                      <ul>
                        <li><a href="">Contacto</a></li>
                      </ul>
                    </li>
                    <li class="dropdown">
                      <a href="/TuRifadigi/sorteo">SORTEOS
                        <span class="main-menu-border"></span>
                      </a>

                    </li>
                    <li class="dropdown" S>
                      <a href="/TuRifadigi/register">crear cuenta
                        <span class="main-menu-border"></span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="main-menu__right">
                <div class="main-menu__cart-search-box">
                </div>
                <div class="main-menu__btn-box">
                  <a href="/TuRifadigi/login" class="main-menu__btn thm-btn">Iniciar Sesión</a>
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