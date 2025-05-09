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
      <h1 style="color: #5497CC;" class=" text-center">Boletos Comprados</h1>
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

  fetch('./api/get_purchase', {
      method: 'POST',
      header: {
        'Content-Type': 'application/json'
      }
    }).then(response => response.json())
    .then(dataD => {
      if (dataD.success) {

        let i = 0;
        let data = dataD.data;

        data.forEach((elemento, index) => {
          let boletos = elemento.boletos ? elemento.boletos.join(", ") : "";
          let acciones = elemento['estado'] == 'pagado' ? `<div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-secondary btn-sm" onclick="pregunta(${elemento['id_compra']}, 1,1)" data-bs-toggle-tooltip="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip tooltip-inner" data-bs-title="Confirmar Pago" ${elemento['estado'] === 'Pagado' ? 'disabled' : ''}>
                          <i class="fa-solid fa-arrows-up-down-left-right fa-md"></i>
                        </button>
                    </div>` : `<div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-info btn-sm" onclick="pregunta(${elemento['id_compra']}, 1,0)" data-bs-toggle-tooltip="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip tooltip-inner" data-bs-title="Confirmar Pago">
                            <i class="fa-solid fa-pen"></i>
                        </button>`;
          data[i]['contador'] = (i + 1);
          data[i]['boletos'] = boletos;
          data[i]['acciones'] = acciones;
          data[i]['estado'] = elemento['estado'] == 'pagado' ? `<small class="d-inline-flex px-2 py-1 fw-semibold text-success-emphasis bg-success-subtle border border-success-subtle rounded-2">Pagado</small>` : `<small class="d-inline-flex px-2 py-1 fw-semibold text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-2">Pendiente</small>`;
          i++;
        })

        const datos = {
          'id_tabla': '#tabla',
          'data': data,
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

      } else {
        console.error('Error al cargar los datos de la tabla:', data.error);
      }
    })
    .catch(error => console.error('Error:', error));

  // SWEETAL ALERT PARA CONFIRMAR PAGO

  async function pregunta(id, condition = false, pagdo = null) {

    const response = await fetch('./compras/view/accions_view?acvi=' + id, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
    });
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const htmlPersonalizado = await response.text();

    if (condition) {
      let title = pagdo == null ? '' : '<h5><span class="pago-confirmado">Pago Confirmado<span class="icono-confirmado"></span><i class="fa-solid fa-check-circle"></i></span></h5>';
      Swal.fire({
        title: title,
        html: htmlPersonalizado,
        showCloseButton: true,
        focusConfirm: false,
        confirmButtonText: `
        cerrar`,
      });
      return;
    }
    Swal.fire({
      html: htmlPersonalizado,
      showCloseButton: true,
      showCancelButton: true,
      showDenyButton: true,
      focusConfirm: false,
      confirmButtonText: `
              verificar`,
      denyButtonText: `
              rechazar`,
      cancelButtonText: `
              cancelar `,

    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "/TuRifadigi/confirmarBoleto/" + id;
      }
    });
  }
</script>
<style>
  .form-section-title {
    justify-content: center;
  }

  .alerta.danger {
    margin: 21px 21px 0;
    color: #842029;
    background-color: #f8d7da;
    border-color: #f5c2c7;
    position: relative;
    padding: 1rem 1rem;
    border: 1px solid transparent;
    border-radius: .25rem;
  }

  .pago-confirmado {
    background-color: #d4edda;
    /* Verde claro de fondo */
    color: #155724;
    /* Verde oscuro del texto */
    padding: 10px 20px;
    /* Espacio interior */
    border-radius: 5px;
    /* Bordes redondeados */
    border: 1px solid #c3e6cb;
    /* Borde sutil */
    display: inline-block;
    /* Para que el ancho se ajuste al contenido */
    font-weight: bold;
    /* Texto en negrita */
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
    /* Sombra suave */
  }

  .icono-confirmado {
    margin-right: 8px;
    /* Espacio entre el icono y el texto */
    font-size: 1.2em;
    /* Tamaño del icono */
    vertical-align: middle;
    /* Alineación vertical con el texto */
  }
</style>
<?php if (!empty($_SESSION['mensaje'])) {
  echo $_SESSION['mensaje'];
  unset($_SESSION['mensaje']);
} ?>