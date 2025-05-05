<?php

// Verificar si el archivo header.php existe antes de incluirlo
require_once __DIR__ . '/../layouts/header.php';


?>

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
                  <a href="/TuRifadigi/login" class="main-slider__btn thm-btn">Comenzar ahora</a>
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
                  <a href="/TuRifadigi/login" class="main-slider__btn thm-btn">Regístrate gratis</a>
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
                  <a href="/TuRifadigi/login" class="main-slider__btn thm-btn">Conoce más</a>
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
          <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
              <?php echo $_SESSION['success'];
              unset($_SESSION['success']); ?>
            </div>
          <?php endif; ?>

          <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
              <?php echo $_SESSION['error'];
              unset($_SESSION['error']); ?>
            </div>
          <?php endif; ?>

          <form action="/TuRifadigi/banner_update" method="POST" enctype="multipart/form-data" class="mb-3">
            <div class="form-group">
              <label for="imagen">Actualizar Banner (Solo PNG o JPG, máximo 5MB)</label>
              <input type="file" class="form-control" id="imagen" name="imagen" accept=".jpg,.jpeg,.png" required>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Actualizar Banner</button>
          </form>

          <div class="why-we-are__img wow slideInRight animated" data-wow-delay="0.1s" data-wow-duration="1500ms">
            <img src="<?php echo htmlspecialchars($imagenFondo); ?>" alt="TuRifaDigital">
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
      <!-- Formulario para crear/editar cuentas de pago -->
      <!--  <div class="container mb-4">
        <form id="formCuentaPago" enctype="multipart/form-data">
          <input type="hidden" name="id" id="idCuenta">
          <input type="hidden" name="imagen_actual" id="imagen_actual">
          <div class="row">
            <div class="col-md-4">
              <input type="text" class="form-control mb-2" name="nombre" id="nombre" placeholder="Nombre del método de pago" required>
            </div>
            <div class="col-md-4">
              <input type="text" class="form-control mb-2" name="tipo" id="tipo" placeholder="Tipo (ej: paypal, banco, zelle)" required>
            </div>
            <div class="col-md-4">
              <input type="text" class="form-control mb-2" name="correo" id="correo" placeholder="Correo electrónico">
            </div>
            <div class="col-md-4">
              <input type="text" class="form-control mb-2" name="usuario" id="usuario" placeholder="Usuario/Nombre de cuenta">
            </div>
            <div class="col-md-4">
              <input type="text" class="form-control mb-2" name="telefono" id="telefono" placeholder="Número de teléfono">
            </div>
            <div class="col-md-4">
              <input type="text" class="form-control mb-2" name="cedula" id="cedula" placeholder="Cédula/DNI">
            </div>
            <div class="col-md-4">
              <input type="file" class="form-control mb-2" name="imagen" id="imagen" accept="image/*">
            </div>
            <div class="col-md-4">
              <button type="submit" class="btn btn-success w-100">Guardar</button>
            </div>
            <div class="col-md-4">
              <button type="button" class="btn btn-secondary w-100" id="btnLimpiar">Limpiar</button>
            </div>
          </div>
        </form>
      </div> -->

      <!-- Aquí se mostrarán las cuentas dinámicamente -->
      <div id="listaCuentas" class="row"></div>

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
            <div class="d-flex justify-content-between mt-2">
              <button class="btn btn-primary btn-sm btnEditar" data-id="ID_AQUI">Editar</button>
              <button class="btn btn-danger btn-sm btnEliminar" data-id="ID_AQUI">Eliminar</button>
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
            <div class="d-flex justify-content-between mt-2">
              <button class="btn btn-primary btn-sm btnEditar" data-id="ID_AQUI">Editar</button>
              <button class="btn btn-danger btn-sm btnEliminar" data-id="ID_AQUI">Eliminar</button>
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
            <div class="d-flex justify-content-between mt-2">
              <button class="btn btn-primary btn-sm btnEditar" data-id="ID_AQUI">Editar</button>
              <button class="btn btn-danger btn-sm btnEliminar" data-id="ID_AQUI">Eliminar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Banco de Venezuela -->
      <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInRight" data-wow-delay="900ms">
        <div class="services-one__single">
          <div class="services-one__img-box">
            <div class="services-one__img">
              <img src="assets/img/svg/venezuela.jpg" alt="Banco de Venezuela">
            </div>
          </div>
          <div class="services-one__content-wrap">
            <h3 class="services-one__title">Banco de Venezuela</h3>
            <div class="services-one__content">
              <p class="services-one__text">Teléfono: 04124124923</p>
              <p class="services-one__text">Cédula: 28517267</p>
            </div>
            <div class="d-flex justify-content-between mt-2">
              <button class="btn btn-primary btn-sm btnEditar" data-id="ID_AQUI">Editar</button>
              <button class="btn btn-danger btn-sm btnEliminar" data-id="ID_AQUI">Eliminar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- 
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      cargarCuentas();

      document.getElementById('formCuentaPago').onsubmit = function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        fetch('/TuRifadigi/cuentas_pago/guardar', {
            method: 'POST',
            body: formData
          })
          .then(r => r.json())
          .then(() => {
            cargarCuentas();
            this.reset();
            document.getElementById('idCuenta').value = '';
            document.getElementById('imagen_actual').value = '';
          });
      };

      document.getElementById('btnLimpiar').onclick = function() {
        document.getElementById('formCuentaPago').reset();
        document.getElementById('idCuenta').value = '';
        document.getElementById('imagen_actual').value = '';
      };

      window.editarCuenta = function(cuenta) {
        document.getElementById('idCuenta').value = cuenta.id;
        document.getElementById('nombre').value = cuenta.nombre;
        document.getElementById('correo').value = cuenta.correo || '';
        document.getElementById('usuario').value = cuenta.usuario || '';
        document.getElementById('telefono').value = cuenta.telefono || '';
        document.getElementById('cedula').value = cuenta.cedula || '';
        document.getElementById('imagen_actual').value = cuenta.imagen;
      };

      window.eliminarCuenta = function(id) {
        if (confirm('¿Seguro que deseas eliminar esta cuenta?')) {
          fetch('/TuRifadigi/cuentas_pago/eliminar', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
              },
              body: 'id=' + id
            })
            .then(r => r.json())
            .then(() => cargarCuentas());
        }
      };

      function cargarCuentas() {
        fetch('/TuRifadigi/cuentas_pago/listar')
          .then(r => r.json())
          .then(cuentas => {
            let html = '';
            cuentas.forEach(cuenta => {
              html += `
            <div class="col-xl-3 col-lg-6 col-md-6">
              <div class="services-one__single">
                <div class="services-one__img-box">
                  <div class="services-one__img">
                    <img src="${cuenta.imagen}" alt="${cuenta.nombre}">
                  </div>
                </div>
                <div class="services-one__content-wrap">
                  <h3 class="services-one__title">${cuenta.nombre}</h3>
                  <div class="services-one__content">
                    ${cuenta.correo ? `<p class="services-one__text">Correo: ${cuenta.correo}</p>` : ''}
                    ${cuenta.usuario ? `<p class="services-one__text">Usuario: ${cuenta.usuario}</p>` : ''}
                    ${cuenta.telefono ? `<p class="services-one__text">Teléfono: ${cuenta.telefono}</p>` : ''}
                    ${cuenta.cedula ? `<p class="services-one__text">Cédula: ${cuenta.cedula}</p>` : ''}
                  </div>
                  <div class="d-flex justify-content-between mt-2">
                    <button class="btn btn-primary btn-sm" onclick='editarCuenta(${JSON.stringify(cuenta)})'>Editar</button>
                    <button class="btn btn-danger btn-sm" onclick='eliminarCuenta(${cuenta.id})'>Eliminar</button>
                  </div>
                </div>
              </div>
            </div>
          `;
            });
            document.getElementById('listaCuentas').innerHTML = html;
          });
      }
    });
  </script> 
  -->
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
<?php
require_once 'views/layouts/footer.php';
?>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>

<!-- <script>
  let contador = 1; // Para IDs únicos

  function agregarCartaDesdeForm() {
    const nombre = document.getElementById("nombreCarta").value || "Sin nombre";
    const info = document.getElementById("infoCarta").value || "Sin información";
    const img = document.getElementById("imgCarta").value || "assets/img/backgrounds/default.png";

    const contenedor = document.getElementById("contenedorCartas");
    const nuevaCarta = document.createElement("div");
    nuevaCarta.className = "col-xl-3 col-lg-6 col-md-6 wow fadeInLeft";
    nuevaCarta.setAttribute("data-wow-delay", "300ms");

    const id = `carta-${contador++}`;

    nuevaCarta.innerHTML = `
      <div class="services-one__single">
        <div class="services-one__img-box">
          <div class="services-one__img">
            <img src="${img}" alt="${nombre}">
          </div>
        </div>
        <div class="services-one__content-wrap">
          <h3 class="services-one__title">${nombre}</h3>
          <div class="services-one__content">
            <p class="services-one__text">${info}</p>
          </div>
          <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-primary btn-sm btnEditar" onclick="editarCarta('${id}')">Editar</button>
            <button class="btn btn-danger btn-sm btnEliminar" onclick="eliminarCarta('${id}')">Eliminar</button>
          </div>
        </div>
      </div>
    `;
    nuevaCarta.id = id;
    contenedor.appendChild(nuevaCarta);

    // Limpiar el formulario
    document.getElementById("nombreCarta").value = "";
    document.getElementById("infoCarta").value = "";
    document.getElementById("imgCarta").value = "";
  }

  // Función para eliminar carta
  function eliminarCarta(id) {
    const carta = document.getElementById(id);
    if (carta) carta.remove();
  }

  // (Opcional) Función para editar carta
  function editarCarta(id) {
    const carta = document.getElementById(id);
    if (!carta) return;
    const nombre = prompt("Nuevo nombre:", carta.querySelector(".services-one__title").innerText);
    const info = prompt("Nueva información:", carta.querySelector(".services-one__text").innerText);
    if (nombre) carta.querySelector(".services-one__title").innerText = nombre;
    if (info) carta.querySelector(".services-one__text").innerText = info;
  }
</script> -->