<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title> TuRifaDigi </title>
  <!-- favicons Icons -->
  <link rel="apple-touch-icon" sizes="180x180" href="assets/img/ico/TuRifadigi.ico" />
  <link rel="icon" type="image/png" sizes="32x32" href="assets/img/ico/TuRifadigi.ico" />
  <link rel="icon" type="image/png" sizes="16x16" href="assets/img/ico/TuRifadigi.ico" />
  <link rel="manifest" href="assets/img/favicons/site.webmanifest" />
  <meta name="description" content="TuRifaDigital" />
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

  <!-- Scripts adicionales CSS -->
  <link rel="stylesheet" href="vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="vendor/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css">
  <link rel="stylesheet" href="vendor/select2/css/select2.min.css">
  <link rel="stylesheet" href="vendor/datatables/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="vendor/dropzone/dropzone.css">
  <link rel="stylesheet" href="vendor/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="vendor/toastr/toastr.min.css">
</head>

<body class="custom-cursor">
  <div class="custom-cursor__cursor"></div>
  <div class="custom-cursor__cursor-two"></div>
  <div class="preloader">
    <div class="preloader__image"></div>
  </div>
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
                    <li class="dropdown"></li>
                    <li class="dropdown">
                      <a href="/turifadigi/">Inicio
                        <span class="main-menu-border"></span>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="/TuRifadigi/boletos">Verificar compras</a></li>
                        <li><a href="/TuRifadigi/rifa_config">Editar sorteo</a></li>
                        <li><a href="/TuRifadigi/main_config">Crear sorteo</a></li>
                      </ul>
                    </li>
                    <li class="element">
                      <a href="#">Compras
                        <span class="main-menu-border"></span>
                      </a>
                    </li>
                    <li class="element">
                      <a href="/TuRifadigi/sorteo">Sorteo
                        <span class="main-menu-border"></span>
                      </a>
                    </li>
                    <?php

                    if ($route === '/login') {
                      echo '
                      <li class="element">
                        <a href="/TuRifadigi/signup">crear cuenta
                          <span class="main-menu-border"></span>
                        </a>
                      </li>';
                    } ?>
                  </ul>
                </div>
              </div>

              <?php
              if ($route === '/signup') {
                echo '
                <div class="main-menu__right">
                  <div class="main-menu__cart-search-box">
                  </div>
                  <div class="main-menu__btn-box">
                    <a href="/TuRifadigi/login" class="main-menu__btn thm-btn">Iniciar Sesión</a>
                  </div>
                </div>';
              }
              ?>
            </div>
          </div>
        </div>
      </nav>
    </header>


    <div class="stricky-header stricked-menu main-menu">
      <div class="sticky-header__content"></div>
    </div>

    <section class="page-header">

      <style>
        .page-header {
          position: relative;
          width: 100%;
          height: 100vh;
          overflow: hidden;
          display: flex;
          align-items: center;
          justify-content: center;
        }

        .page-header__bg2 {
          position: absolute;
          left: 0;
          width: 100%;
          height: 100%;
          background-image: url(assets/img/backgrounds/MotoYorsi.webp);
          background-size: cover;
          background-position: center;
          background-repeat: no-repeat;
          filter: brightness(0.4);
          transform: scale(1);
          transition: all 0.5s ease;
          object-fit: cover;
        }

        .page-header__content {
          position: relative;
          z-index: 2;
          text-align: center;
          padding: 20px;
          max-width: 800px;
          margin: 0 auto;
        }

        .page-header__title {
          font-size: clamp(2.5rem, 5vw, 4rem);
          font-weight: 700;
          color: white;
          margin-bottom: 1rem;
          text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .page-header__subtitle {
          font-size: clamp(1.8rem, 4vw, 2.5rem);
          color: #3d7bff;
          margin-bottom: 1rem;
          text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        }

        .page-header__text {
          font-size: clamp(1rem, 2vw, 1.2rem);
          color: white;
          margin-bottom: 2rem;
          max-width: 600px;
          margin-left: auto;
          margin-right: auto;
          line-height: 1.6;
        }

        @keyframes fadeInUp {
          from {
            opacity: 0;
            transform: translateY(20px);
          }

          to {
            opacity: 1;
            transform: translateY(0);
          }
        }

        .page-header__content>* {
          animation: fadeInUp 0.8s ease forwards;
        }

        .page-header__title {
          animation-delay: 0.2s;
        }

        .page-header__subtitle {
          animation-delay: 0.4s;
        }

        .page-header__text {
          animation-delay: 0.6s;
        }

        @media (max-width: 768px) {
          .page-header {
            height: 90vh;
          }

          .page-header__bg2 {
            background-size: cover;
            background-position: 40% center;
          }
        }

        @media (max-width: 480px) {
          .page-header {
            height: 80vh;
          }

          .page-header__bg2 {
            background-size: cover;
            background-position: 50% center;
          }
        }

        @media (max-height: 500px) and (orientation: landscape) {
          .page-header {
            height: 120vh;
          }

          .page-header__content {
            padding-top: 40px;
          }
        }
      </style>

      <div class="page-header__bg2"></div>

      <div class="page-header__content">
        <h1 class="page-header__title">TuRifaDigital</h1>
        <h2 class="page-header__subtitle">Tu Mejor Opción</h2>
        <p class="page-header__text">Crea y gestiona tus rifas de manera fácil y segura.</p>
      </div>

    </section>