<?php require_once 'views/auth/header_login.php'; ?>
<!--Contact Two Start-->
<section class="contact-two">
  <div class="contact-two__img-1 wow fadeInLeft" data-wow-delay="300ms">
    <img src="assets/images/resources/contact-two-img-1.png" alt="" class="float-bob-x">
  </div>
  <div class="contact-two__bg-shape"></div>
  <div class="contact-two__bg-shape-2"></div>
  <div class="contact-two__google-map">
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4562.753041141002!2d-118.80123790098536!3d34.152323469614075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80e82469c2162619%3A0xba03efb7998eef6d!2sCostco+Wholesale!5e0!3m2!1sbn!2sbd!4v1562518641290!5m2!1sbn!2sbd"
      class="contact-two__map" allowfullscreen></iframe>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-xl-8">
        <div class="contact-two__left">
          <div class="section-title text-left">
            <div class="section-title__tagline-box">
              <div class="section-title__tagline-shape">
                <img src="assets/images/shapes/section-title-tagline-shape.png" alt="">
              </div>
              <span class="section-title__tagline"></span>
            </div>
            <h2 class="section-title__title">Iniciar sesión
              <br>
            </h2>
          </div>
          <form class="contact-form-validated contact-two__form" action="registro_usuario"
            method="post" novalidate="novalidate">
            <div class="row">
              <div class="col-xl-6 col-lg-6">
                <div class="contact-two__input-box">
                  <input type="text" name="name" placeholder="Nombre del usuario" required="">
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <div class="contact-two__input-box">
                  <input type="text" name="password" placeholder="Contraseña" required="">
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6">
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6">
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6">
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6">
              <div class="contact-two__btn-box">
                <button type="submit" class="thm-btn contact-two__btn">Iniciar sesión</button>
              </div>
            </div>
        </div>
        </form>


        
 <?php if (!empty($_SESSION['mensaje'])) {
    echo $_SESSION['mensaje'];
    unset($_SESSION['mensaje']);
  } ?>

        <div class="result"></div>
        <p class="contact-two__left-text"><a href="/TuRifadigi/login">No tiene cuenta?</a><!--  <a href="<?php echo $_ENV['APP_URL'] . $_ENV['BASE_PATH']; ?>/auth/login">Inicia sesión</a> --></p>
      </div>
    </div>
  </div>
  </div>
</section>





<?php require_once 'views/auth/footer_login.php'; ?>