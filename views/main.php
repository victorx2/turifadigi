<?php
require_once 'views/layouts/header.php';
?>
<!--Main Slider Start-->
<section class="main-slider">
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
    <div class="swiper-wrapper">

      <div class="swiper-slide">
        <div class="main-slider__bg" style="background-image: url(assets/img/backgrounds/sorteo.jpg);"></div>
        <div class="main-slider__shape-bg" style="background-image: url(assets/img/shapes/main-slider-shape-bg.png);"></div>
        <div class="main-slider__shape-1 float-bob-y">
          <img src="assets/img/shapes/main-slider-shape-1.png" alt="">
        </div>
        <div class="main-slider__shape-2 img-bounce">
          <img src="assets/img/shapes/main-slider-shape-2.png" alt="">
        </div>
        <div class="container">
          <div class="row">
            <div class="col-xl-12">
              <div class="main-slider__content">
                <h2 class="main-slider__title">TuRifaDigital <br> <span>Tu mejor opción</span> <br> para rifas</h2>
                <p class="main-slider__text">Crea y gestiona tus rifas de manera <br> fácil y segura.</p>
                <div class="main-slider__btn-box">
                  <a href="/login" class="main-slider__btn thm-btn">Comenzar ahora</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="swiper-slide">
        <div class="main-slider__bg" style="background-image: url(assets/img/backgrounds/slider-1-2.jpg);"></div>
        <div class="main-slider__shape-bg" style="background-image: url(assets/img/shapes/main-slider-shape-bg.png);"></div>
        <div class="main-slider__shape-1 float-bob-y">
          <img src="assets/img/shapes/main-slider-shape-1.png" alt="">
        </div>
        <div class="main-slider__shape-2 img-bounce">
          <img src="assets/img/shapes/main-slider-shape-2.png" alt="">
        </div>
        <div class="container">
          <div class="row">
            <div class="col-xl-12">
              <div class="main-slider__content">
                <h2 class="main-slider__title">Gestiona tus <br> <span>Rifas</span> <br> con facilidad</h2>
                <p class="main-slider__text">Control total sobre tus sorteos <br> y participantes.</p>
                <?php
                $session = $_SESSION['usuario'] ?? '';
                if ($session === '') {
                  echo '<div class="main-slider__btn-box">
                            <a href="/login" class="main-slider__btn thm-btn">Regístrate gratis</a>
                          </div>';
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="swiper-slide">
        <div class="main-slider__bg" style="background-image: url(assets/img/backgrounds/slider-1-3.jpg);"></div>
        <div class="main-slider__shape-bg" style="background-image: url(assets/img/shapes/main-slider-shape-bg.png);"></div>
        <div class="main-slider__shape-1 float-bob-y">
          <img src="assets/img/shapes/main-slider-shape-1.png" alt="">
        </div>
        <div class="main-slider__shape-2 img-bounce">
          <img src="assets/img/shapes/main-slider-shape-2.png" alt="">
        </div>
        <div class="container">
          <div class="row">
            <div class="col-xl-12">
              <div class="main-slider__content">
                <h2 class="main-slider__title">Sistema de <br> <span>Pagos</span> <br> Seguro</h2>
                <p class="main-slider__text">Múltiples métodos de pago <br> y transacciones seguras.</p>
                <div class="main-slider__btn-box">
                  <a href="/login" class="main-slider__btn thm-btn">Conoce más</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="swiper-pagination" id="main-slider-pagination"></div>
  </div>
</section>
<!--Main Slider End-->


<!--Why We Are Start-->
<section class="why-we-are">
  <div class="why-we-are__bg" style="background-image: url(assets/img/backgrounds/why-we-are-bg.jpg);">
  </div>
  <div class="why-we-are__bg-shape" style="background-image: url(assets/img/shapes/why-we-are-bg-shape.png);"></div>
  <div class="why-we-are__shape-1">
    <img src="assets/img/shapes/why-we-are-shape-1.png" alt="">
  </div>
  <div class="container">
    <div class="row">
      <div class="col-xl-5">
        <div class="why-we-are__left">
          <div class="section-title text-left">
            <div class="section-title__tagline-box">
              <span class="section-title__tagline">¿Qué es TuRifaDigital?</span>
            </div>
            <h2 class="section-title__title">Tu plataforma para <br> seleccionar boletos y pagar</h2>
          </div>
          <p class="why-we-are__text">TuRifaDigital es la herramienta perfecta para participar en sorteos de manera sencilla. Nuestra plataforma te permite seleccionar tus boletos favoritos y realizar el pago de forma segura y rápida.</p>
          <ul class="why-we-are__points-box list-unstyled">
            <li>
              <div class="icon">
                <span class="icon-tiles"></span>
              </div>
              <div class="content">
                <h3>Selección de Boletos</h3>
                <p>Elige los números que prefieras de manera fácil e intuitiva.</p>
              </div>
            </li>
            <li>
              <div class="icon">
                <span class="icon-analytics1"></span>
              </div>
              <div class="content">
                <h3>Pago Seguro</h3>
                <p>Realiza tus pagos con total confianza y protección.</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-xl-7">
        <div class="why-we-are__right">
          <div class="why-we-are__img wow slideInRight animated" data-wow-delay="0.1s" data-wow-duration="1500ms">
            <img src="assets/img/backgrounds/sorteo.jpg" alt="TuRifaDigital">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-xl-12">
        <br>
        <br>
        <br>
        <!--  
        <div class="section-title text-center">
          <h2 class="section-title__title">Metodos de Pago</h2>
        </div> 
        -->
      </div>
    </div>
  </div>

</section>



<!--Why We Are End-->

<!--Services One Start-->

<section class="services-one">
  <style>
    .services-one__content {
      transition: all 0.3s ease;
      overflow: hidden;
      max-height: 0;
    }

    .services-one__single {
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .services-one__single:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .services-one__single.active .services-one__content {
      max-height: 500px;
      padding: 15px;
    }

    .services-one__title {
      margin-bottom: 0;
      padding: 15px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .services-one__title:after {
      content: '▼';
      font-size: 12px;
      transition: transform 0.3s ease;
    }

    .services-one__single.active .services-one__title:after {
      transform: rotate(180deg);
    }

    .services-one__text {
      margin: 25px 0 0;
      opacity: 0.9;
    }
  </style>

  <div class="container">


    <div class="section-title text-center">
      <div class="section-title__tagline-box">
        <div class="section-title__tagline-shape"></div>
        <span class="section-title__tagline"></span>
      </div>
      <h2 class="section-title__title">Métodos de Pago</h2>
    </div>
    <div class="payment-methods row">
      <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="100ms">
        <div class="payment-method" onclick="mostrarDatosDePago('pago_movil')">
          <div class="services-one__img-box">
            <div class="services-one__img">
              <img src="assets/img/webp/pago_movil.webp" alt="Pago Móvil">
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="200ms">
        <div class="payment-method" onclick="mostrarDatosDePago('zelle')">
          <div class="services-one__img-box">
            <div class="services-one__img">
              <img src="assets/img/webp/zelle.webp" alt="Zelle">
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="300ms">
        <div class="payment-method" onclick="mostrarDatosDePago('davivienda')">
          <div class="services-one__img-box">
            <div class="services-one__img">
              <img src="assets/img/webp/davivienda.webp" alt="Davivienda">
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="400ms">
        <div class="payment-method" onclick="mostrarDatosDePago('paypal')">
          <div class="services-one__img-box">
            <div class="services-one__img">
              <img src="assets/img/webp/paypal.webp" alt="Paypal">
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="500ms">
        <div class="payment-method" onclick="mostrarDatosDePago('banco_venezuela')">
          <div class="services-one__img-box">
            <div class="services-one__img">
              <img src="assets/img/webp/banco_venezuela.webp" alt="Banco de Venezuela">
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="600ms">
        <div class="payment-method" onclick="mostrarDatosDePago('bancolombia')">
          <div class="services-one__img-box">
            <div class="services-one__img">
              <img src="assets/img/webp/bancolombia.webp" alt="Bancolombia">
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- <div class="section-title text-center">
      <div class="section-title__tagline-box">
        <div class="section-title__tagline-shape"></div>
        <span class="section-title__tagline"></span>
      </div>
      <h2 class="section-title__title">Metodos de Pago</h2>
    </div>
    <div class="row">
     
      <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="100ms">
        <div class="services-one__single">
          <div class="services-one__img-box">
            <div class="services-one__img">
              <img src="assets/img/backgrounds/zelle.png" alt="Zelle">
            </div>
          </div>
          <div class="services-one__content-wrap">
            <div class="services-one__content">
              <h3 class="services-one__title">Zelle</h3>
              <p class="services-one__text">Número de telefono: +1 4074287580</p>
            </div>
          </div>
        </div>
      </div>

     
      <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="300ms">
        <div class="services-one__single">
          <div class="services-one__img-box">
            <div class="services-one__img">
              <img src="assets/img/backgrounds/Nesqui.png" alt="Nesqui">
            </div>
          </div>
          <div class="services-one__content-wrap">
            <div class="services-one__content">
              <h3 class="services-one__title">Nequi</h3>
              <p class="services-one__text">Información próximamente</p>
            </div>
          </div>
        </div>
      </div>

      
      <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInRight" data-wow-delay="600ms">
        <div class="services-one__single">
          <div class="services-one__img-box">
            <div class="services-one__img">
              <img src="assets/img/backgrounds/paypa.jpg" alt="Paypal">
            </div>
          </div>
          <div class="services-one__content-wrap">
            <div class="services-one__content">
              <h3 class="services-one__title">Paypal</h3>
              <p class="services-one__text">Nombre: Yorsin Cruz Osorio</p>
              <p class="services-one__text">Correo: Yorsincruz1995@gmail.com</p>
              <p class="services-one__text">Usuario: @Yorsin0506</p>
              <p class="services-one__text">Teléfono: +1 4074287580</p>
            </div>
          </div>
        </div>
      </div>

       
      <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInRight" data-wow-delay="900ms">
        <div class="services-one__single">
          <div class="services-one__img-box">
            <div class="services-one__img">
              <img src="assets/img/backgrounds/venezuela.jpg" alt="Banco de Venezuela">
            </div>
          </div>
          <div class="services-one__content-wrap">
            <div class="services-one__content">
              <h3 class="services-one__title">Banco de Venezuela</h3>
              <p class="services-one__text">Teléfono: 04124124923</p>
              <p class="services-one__text">Cédula: 28517267</p>
            </div>
          </div>
        </div>
      </div>
    </div> -->
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const serviceCards = document.querySelectorAll('.services-one__single');

      serviceCards.forEach(card => {
        card.addEventListener('click', function() {
          // Toggle active class on the clicked card
          this.classList.toggle('active');

          // Optional: Close other cards when one is opened
          serviceCards.forEach(otherCard => {
            if (otherCard !== this && otherCard.classList.contains('active')) {
              otherCard.classList.remove('active');
            }
          });
        });
      });
    });
  </script>
  <style>
    .payment-methods .payment-method {
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #f9f9f9;
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 15px;
      transition: all 0.3s ease;
      height: 150px;
      width: 100%;
      margin: 10px 0 10px 0;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .payment-methods .payment-method:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .payment-methods .payment-method img {
      max-height: 100px;
      max-width: 100%;
      object-fit: contain;
    }
  </style>
</section>
<!--Services One End-->
<?php
require_once 'views/layouts/footer.php';
?>