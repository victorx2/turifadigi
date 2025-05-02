<?php include_once "views/layouts/header.php"; ?>

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
        <div class="main-slider__shape-bg" style="background-image: url(assets/img/shapes/main-slider-shature-bg.png);"></div>
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

<div class="container-lg">
  <div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8 mb-4">
      <h1 style="color: #5497CC;" class=" text-center">Administración de Boletos</h1>
      <h5 class=" text-center"> <strong>- Gestión de Boletos de Rifa -</strong> </h5>
    </div>
    <div class="col-lg-2"></div>
  </div>
  <div class="row mb-3">
    <div class="col-lg-2"></div>
    <div class="col-lg-8 mb-2 d-flex justify-content-center">
    </div>
  </div>
  <div class="row justify-content-center mb-3">
    <div class="col-lg-12 table-responsive">
      <table id="tabla" class="table table-sm table-bordered table-hover mb-0">
        <thead class="align-middle">
          <tr>
            <th class="text-center bg-body-tertiary" width="1%">#</th>
            <th class="text-center bg-body-tertiary" width="20%">FECHA DE COMPRA</th>
            <th class="text-center bg-body-tertiary" width="25%">COMPRADOR</th>
            <th class="text-center bg-body-tertiary" width="20%">BOLETOS</th>
            <th class="text-center bg-body-tertiary" width="10%">MONTO</th>
            <th class="text-center bg-body-tertiary" width="10%">ESTADO</th>
            <th class="text-center bg-body-tertiary" width="14%">ACCIONES</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>


<?php include_once "views/layouts/footer.php"; ?>


<script>
  // CARGA DE LA TABLA

  let dataD = JSON.parse('<?php echo $dataJSON; ?>');
  let i = 0;

  dataD.forEach((elemento, index) => {
    let boletos = elemento.boletos ? elemento.boletos.join(", ") : "";
    let acciones = `<div class="btn-group" role="group" aria-label="Basic example">
                        <div data-bs-toggle-tooltip="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip tooltip-inner" data-bs-title="${elemento['estado'] === 'Pagado' ? 'Botón Bloqueado' : 'Editar'}">
                        </div>
                        <button type="button" class="btn btn-success btn-sm" onclick="pregunta(${elemento['id_compra']})" data-bs-toggle-tooltip="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip tooltip-inner" data-bs-title="Confirmar Pago" ${elemento['estado'] === 'Pagado' ? 'disabled' : ''}>
                            <i class="fa-solid fa-check"></i>
                        </button>
                    </div>`;
    dataD[i]['contador'] = (i + 1);
    dataD[i]['boletos'] = boletos;
    dataD[i]['acciones'] = acciones;
    dataD[i]['estado'] = elemento['estado'] === 'Pagado' ? `<small class="d-inline-flex px-2 py-1 fw-semibold text-success-emphasis bg-success-subtle border border-success-subtle rounded-2">Pagado</small>` : `<small class="d-inline-flex px-2 py-1 fw-semibold text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-2">Pendiente</small>`;
    i++;
  })

  const datos = {
    'id_tabla': '#tabla',
    'data': dataD,
    'columns': [{
        'data': 'contador',
        'title': '#',
        'className': 'text-center'
      },
      {
        'data': 'fecha_compra',
        'title': 'FECHA DE COMPRA',
        'className': 'text-center'
      },
      {
        'data': 'cliente',
        'title': 'COMPRADOR',
        'className': 'text-center'
      },
      {
        'data': 'boletos',
        'title': 'BOLETOS',
        'className': 'text-center'
      },
      {
        'data': 'total',
        'title': 'MONTO',
        'className': 'text-center'
      },
      {
        'data': 'estado',
        'title': 'ESTADO',
        'className': 'text-center'
      },
      {
        'data': 'acciones',
        'title': 'ACCIONES',
        'className': 'text-center'
      }
    ]
  };

  cargar_tabla_boletos(datos);


  function pregunta(id) {
    Swal.fire({
      title: "Pregunta",
      text: "¿Está seguro de que verifico este código?",
      icon: "question",
      showCancelButton: true,
      confirmButtonText: "Si, estoy seguro!",
      confirmButtonColor: "#28A745",
      cancelButtonText: "No, no estoy seguro.",
      cancelButtonColor: "#d33",
      reverseButtons: "true"
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "/TuRifadigi/confirmarBoleto/" + id;
      }
    });
  }
</script>

<?php if (!empty($_SESSION['mensaje'])) {
  echo $_SESSION['mensaje'];
  unset($_SESSION['mensaje']);
} ?>