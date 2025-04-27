<link rel="stylesheet" href="assets/css/boletos.css">

<!--Main Slider Start-->
<section class="main-slider">
  <!-- Contenedor principal del slider usando Swiper -->
  <div class="swiper-container thm-swiper__slider" data-swiper-options='{"slidesPerView": 1, "loop": true,
                "effect": "fade",
                "pagination": {
                "el": "#main-slider-pagination",
                "type": "bullets",
                "clickable": true
                },
                "navigation": {
                "nextEl": "#main-slider__swiper-button-next",
                "prevEl": "#main-slider__swiper-button-prev"
                },
                "autoplay": {
                    "delay": 8000
                } 
            }'>
    <!-- Contenedor de slides -->
    <div class="swiper-wrapper">

      <!-- Primer slide -->
      <div class="swiper-slide">
        <!-- Fondo y formas decorativas -->
        <div class="main-slider__bg" style="background-image: url(assets/img/backgrounds/sorteo.jpg);"></div>
        <div class="main-slider__shape-bg" style="background-image: url(assets/img/shapes/main-slider-shape-bg.png);"></div>
        <div class="main-slider__shape-1 float-bob-y">
          <img src="assets/img/shapes/main-slider-shape-1.png" alt="">
        </div>
        <div class="main-slider__shape-2 img-bounce">
          <img src="assets/img/shapes/main-slider-shape-2.png" alt="">
        </div>
        <!-- Contenido del slide -->
        <div class="container">
          <div class="row">
            <div class="col-xl-12">
              <div class="main-slider__content">
                <h2 class="main-slider__title">TuRifaDigital <br> <span>Tu mejor opción</span> <br> para rifas</h2>
                <p class="main-slider__text">Crea y gestiona tus rifas de manera <br> fácil y segura.</p>
                <div class="main-slider__btn-box">
                  <a href="/TuRifadigi/login" class="main-slider__btn thm-btn">Comenzar ahora</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Segundo slide -->
      <div class="swiper-slide">
        <!-- Fondo y formas decorativas -->
        <div class="main-slider__bg" style="background-image: url(assets/img/backgrounds/slider-1-2.jpg);"></div>
        <div class="main-slider__shape-bg" style="background-image: url(assets/img/shapes/main-slider-shature-bg.png);"></div>
        <div class="main-slider__shape-1 float-bob-y">
          <img src="assets/img/shapes/main-slider-shape-1.png" alt="">
        </div>
        <div class="main-slider__shape-2 img-bounce">
          <img src="assets/img/shapes/main-slider-shape-2.png" alt="">
        </div>
        <!-- Contenido del slide -->
        <div class="container">
          <div class="row">
            <div class="col-xl-12">
              <div class="main-slider__content">
                <h2 class="main-slider__title">Gestiona tus <br> <span>Rifas</span> <br> con facilidad</h2>
                <p class="main-slider__text">Control total sobre tus sorteos <br> y participantes.</p>
                <div class="main-slider__btn-box">
                  <a href="/TuRifadigi/login" class="main-slider__btn thm-btn">Regístrate gratis</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Tercer slide -->
      <div class="swiper-slide">
        <!-- Fondo y formas decorativas -->
        <div class="main-slider__bg" style="background-image: url(assets/img/backgrounds/slider-1-3.jpg);"></div>
        <div class="main-slider__shape-bg" style="background-image: url(assets/img/shapes/main-slider-shape-bg.png);"></div>
        <div class="main-slider__shape-1 float-bob-y">
          <img src="assets/img/shapes/main-slider-shape-1.png" alt="">
        </div>
        <div class="main-slider__shape-2 img-bounce">
          <img src="assets/img/shapes/main-slider-shape-2.png" alt="">
        </div>
        <!-- Contenido del slide -->
        <div class="container">
          <div class="row">
            <div class="col-xl-12">
              <div class="main-slider__content">
                <h2 class="main-slider__title">Sistema de <br> <span>Pagos</span> <br> Seguro</h2>
                <p class="main-slider__text">Múltiples métodos de pago <br> y transacciones seguras.</p>
                <div class="main-slider__btn-box">
                  <a href="/TuRifadigi/login" class="main-slider__btn thm-btn">Conoce más</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Paginación del slider -->
    <div class="swiper-pagination" id="main-slider-pagination"></div>
  </div>
</section>
<!--Main Slider End-->
<?php require_once 'premio.php'; ?>
<!--Services One Start-->
<section class="services-one">
  <div class="container">
    <!-- Título y contador de boletos -->
    <div class="section-title text-center">
      <h2 class="section-title__title">LISTA DE BOLETOS</h2>
      <div class="progress-contain">
        <div class="progress-actual" style="width: 0%;"></div>
        <div class="progress-total"></div>
        <div class="progress-percent" id="progress-percent" style="left: 0%;">0%</div>
      </div>
      <div class="counter-section">
        <button class="thm-btn counter-btn minus">-</button>
        <div class="counter-display">
          <span id="currentCount">3</span>
          <span class="counter-label">BOLETOS</span>
        </div>
        <button class="thm-btn counter-btn plus">+</button>
      </div>
      <div class="total-amount">
        Total: <span id="totalAmount">12.00 USD</span>
      </div>
    </div>

    <!-- Barra de búsqueda -->
    <div class="search-box">
      <input type="text" id="searchInput" class="form-control" placeholder="BUSCAR">
      <button class="thm-btn search-btn">
        <i class="fas fa-search"></i> BUSCAR
      </button>
    </div>

    <!-- Sección para elegir boletos al azar -->
    <div class="elegir-suerte">
      ★ ELEGIR A LA SUERTE ★
    </div>

    <!-- Contenedor de la grilla de boletos -->
    <div class="boletos-container">
      <div class="boletos-grid" id="boletosGrid">
        <!-- Los boletos se generarán dinámicamente aquí -->
      </div>
    </div>

    <!-- Sección de boletos seleccionados -->
    <div class="selected-section">
      <div class="selected-header">
        SELECCIONADOS
        <span id="selectedCounter">0 de 3</span>
      </div>
      <div class="selected-numbers" id="selectedNumbers">
        <!-- Los números seleccionados aparecerán aquí -->
      </div>
      <button class="thm-btn continue-btn" id="continueBtn" disabled>
        CONTINUAR
      </button>
    </div>
  </div>
</section>
<!--Services One End-->
<?php require_once 'verificador_boletos.php'; ?>
<link rel="stylesheet" href="assets/css/verificador.css">
<script src="assets/js/boletos.js"></script>
<?php require_once 'views/sorteo/whatsapp.php'; ?>
<?php require_once 'views/sorteo/personal.php'; ?>