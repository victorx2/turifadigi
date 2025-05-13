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
                                <div class="main-slider__btn-box">
                                    <?php
                                    $session = $_SESSION['usuario'] ?? '';
                                    if ($session === '') {
                                        echo '<a href="/login" class="main-slider__btn thm-btn">Regístrate gratis</a>';
                                    }
                                    ?>
                                </div>
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
                            <span class="section-title__tagline">¿Quiénes Somos?</span>
                        </div>
                        <h2 class="section-title__title">Tu plataforma confiable <br> para rifas digitales</h2>
                    </div>
                    <p class="why-we-are__text">TuRifaDigital es la solución perfecta para crear y gestionar rifas de manera segura y eficiente. Nuestra plataforma está diseñada para ofrecerte las mejores herramientas y garantizar la transparencia en cada sorteo.</p>
                    <ul class="why-we-are__points-box list-unstyled">
                        <li>
                            <div class="icon">
                                <span class="icon-tiles"></span>
                            </div>
                            <div class="content">
                                <h3>Fácil de Usar</h3>
                                <p>Crea y gestiona tus rifas en minutos con nuestra interfaz intuitiva y amigable.</p>
                            </div>
                        </li>
                        <li>
                            <div class="icon">
                                <span class="icon-analytics1"></span>
                            </div>
                            <div class="content">
                                <h3>Seguridad Garantizada</h3>
                                <p>Sistema de pagos seguro y transacciones protegidas para tu tranquilidad.</p>
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
            margin: 5px 0;
            opacity: 0.9;
        }
    </style>

    <div class="container">
        <div class="section-title text-center">
            <div class="section-title__tagline-box">
                <div class="section-title__tagline-shape"></div>
                <span class="section-title__tagline"></span>
            </div>
            <h2 class="section-title__title">Cuentas de pagos</h2>
        </div>
        <div class="row">
            <!-- Zelle -->
            <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="100ms">
                <div class="services-one__single">
                    <div class="services-one__img-box">
                        <div class="services-one__img">
                            <img src="assets/img/backgrounds/zelle.png" alt="Zelle">
                        </div>
                    </div>
                    <div class="services-one__content-wrap">
                        <h3 class="services-one__title">Zelle</h3>
                        <div class="services-one__content">
                            <p class="services-one__text">Número de telefono: +1 4074287580</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nesqui -->
            <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="300ms">
                <div class="services-one__single">
                    <div class="services-one__img-box">
                        <div class="services-one__img">
                            <img src="assets/img/backgrounds/Nesqui.png" alt="Nesqui">
                        </div>
                    </div>
                    <div class="services-one__content-wrap">
                        <h3 class="services-one__title">Nesqui</h3>
                        <div class="services-one__content">
                            <p class="services-one__text">Información próximamente</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Paypal -->
            <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInRight" data-wow-delay="600ms">
                <div class="services-one__single">
                    <div class="services-one__img-box">
                        <div class="services-one__img">
                            <img src="assets/img/backgrounds/paypa.jpg" alt="Paypal">
                        </div>
                    </div>
                    <div class="services-one__content-wrap">
                        <h3 class="services-one__title">Paypal</h3>
                        <div class="services-one__content">
                            <p class="services-one__text">Nombre: Yorsin Cruz Osorio</p>
                            <p class="services-one__text">Correo: Yorsincruz1995@gmail.com</p>
                            <p class="services-one__text">Usuario: @Yorsin0506</p>
                            <p class="services-one__text">Teléfono: +1 4074287580</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Banco de Venezuela -->
            <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInRight" data-wow-delay="900ms">
                <div class="services-one__single">
                    <div class="services-one__img-box">
                        <div class="services-one__img">
                            <img src="assets/img/backgrounds/venezuela.jpg" alt="Banco de Venezuela">
                        </div>
                    </div>
                    <div class="services-one__content-wrap">
                        <h3 class="services-one__title">Banco de Venezuela</h3>
                        <div class="services-one__content">
                            <p class="services-one__text">Teléfono: 04124124923</p>
                            <p class="services-one__text">Cédula: 28517267</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
</section>
<!--Services One End-->

<!--Team One Start-->
<section class="team-one">
    <div class="team-one__bg-box">
        <div class="team-one__bg" style="background-image: url(assets/img/backgrounds/team-one-bg.jpg);">
        </div>
    </div>
    <div class="container">
        <div class="section-title text-center">
            <div class="section-title__tagline-box">
                <div class="section-title__tagline-shape">
                </div>
            </div>
            <h2 class="section-title__title">Ganadores del Sorteo</h2>
        </div>
        <div class="row">
            <!--Team One Single Start-->
            <div class="col-xl-4 col-lg-4 wow fadeInLeft" data-wow-delay="100ms">
                <div class="team-one__single">
                    <div class="team-one__img-box">
                        <div class="team-one__img">
                            <img src="assets/img/team/team-1-1.jpg" loading="lazy" alt="">
                        </div>
                    </div>
                    <div class="team-one__content-inner">
                        <div class="team-one__content">
                            <h3 class="team-one__name"><a href="">Leslie Alexander</a></h3>
                            <p class="team-one__sub-title">Digital Marketer</p>
                            <div class="team-one__social">
                                <a href=""><span class="icon-twitter"></span></a>
                                <a href=""><span class="icon-facebook"></span></a>
                                <a href=""><span class="icon-google-plus-logo"></span></a>
                                <a href=""><span class="icon-pinterest"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Team One Single End-->
            <!--Team One Single Start-->
            <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="200ms">
                <div class="team-one__single">
                    <div class="team-one__img-box">
                        <div class="team-one__img">
                            <img src="assets/img/team/team-1-2.jpg" alt="">
                        </div>
                    </div>
                    <div class="team-one__content-inner">
                        <div class="team-one__content">
                            <h3 class="team-one__name"><a href="">Kendra Pual</a></h3>
                            <p class="team-one__sub-title">Developer</p>
                            <div class="team-one__social">
                                <a href=""><span class="icon-twitter"></span></a>
                                <a href=""><span class="icon-facebook"></span></a>
                                <a href=""><span class="icon-google-plus-logo"></span></a>
                                <a href=""><span class="icon-pinterest"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Team One Single End-->
            <!--Team One Single Start-->
            <div class="col-xl-4 col-lg-4 wow fadeInRight" data-wow-delay="300ms">
                <div class="team-one__single">
                    <div class="team-one__img-box">
                        <div class="team-one__img">
                            <img src="assets/img/team/team-1-3.jpg" alt="">
                        </div>
                    </div>
                    <div class="team-one__content-inner">
                        <div class="team-one__content">
                            <h3 class="team-one__name"><a href="">Devid L.Musilal</a></h3>
                            <p class="team-one__sub-title">Digital Marketer</p>
                            <div class="team-one__social">
                                <a href=""><span class="icon-twitter"></span></a>
                                <a href=""><span class="icon-facebook"></span></a>
                                <a href=""><span class="icon-google-plus-logo"></span></a>
                                <a href=""><span class="icon-pinterest"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Team One Single End-->
        </div>
    </div>
</section>
<!--Team One End-->