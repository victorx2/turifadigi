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

      <script>
        // Redireccionar a una nueva URL
        function redireccionar(url) {
          window.location.href = url;
        }
      </script>

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
                <h2 class="main-slider__title" data-i18n="best_option">TuRifaDigital <br> <span>Tu mejor opción</span> <br> para rifas</h2>
                <p class="main-slider__text" data-i18n="easy_safe">Crea y gestiona tus rifas de manera <br> fácil y segura.</p>
                <div class="main-slider__btn-box">
                  <a href="/login" class="main-slider__btn thm-btn" data-i18n="start_now">Comenzar ahora</a>
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
                <h2 class="main-slider__title" data-i18n="manage_raffles">Gestiona tus <br> <span>Rifas</span> <br> con facilidad</h2>
                <p class="main-slider__text" data-i18n="full_control">Control total sobre tus sorteos <br> y participantes.</p>
                <div class="main-slider__btn-box">
                  <a href="/login" class="main-slider__btn thm-btn" data-i18n="register_free">Regístrate gratis</a>
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
                <h2 class="main-slider__title" data-i18n="payment_system">Sistema de <br> <span>Pagos</span> <br> Seguro</h2>
                <p class="main-slider__text" data-i18n="multiple_methods">Múltiples métodos de pago <br> y transacciones seguras.</p>
                <div class="main-slider__btn-box">
                  <a href="/login" class="main-slider__btn thm-btn" data-i18n="learn_more">Conoce más</a>
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
      <h1 style="color: #5497CC;" class=" text-center" data-i18n="admin_tickets">Administración de Boletos</h1>
      <h5 class=" text-center" data-i18n="admin_tickets_desc">Gestión de Boletos de Rifa</h5>
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
            <th class="text-center bg-body-tertiary" width="1%" data-i18n-th="datatable_number">NUMBER</th>
            <th class="text-center bg-body-tertiary" width="18%" data-i18n-th="purchase_date_2">FECHA DE COMPRA</th>
            <th class="text-center bg-body-tertiary" width="20%" data-i18n-th="datatable_buyer">COMPRADOR</th>
            <th class="text-center bg-body-tertiary" width="1%" data-i18n-th="datatable_raffle">SORTEO</th>
            <th class="text-center bg-body-tertiary" width="15%" data-i18n-th="datatable_tickets">BOLETOS</th>
            <th class="text-center bg-body-tertiary" width="10%" data-i18n-th="datatable_amount">MONTO</th>
            <th class="text-center bg-body-tertiary" width="14%" data-i18n-th="datatable_status">ESTADO</th>
            <th class="text-center bg-body-tertiary" width="14%" data-i18n-th="datatable_actions">ACCIONES</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>


<?php include_once "views/layouts/footer.php"; ?>


<script>
  // CARGA DE LA TABLA

  fetch('./api/get_purchase?cmp=1', {
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
          let acciones;
          if (['aprobado', 'rechazado'].includes(elemento['estado_pago'])) {
            acciones = `
              <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-secondary btn-sm"
                  onclick="pregunta(${elemento['id_compra']}, '${elemento['estado_pago']}')"
                  data-bs-toggle-tooltip="tooltip"
                  data-bs-placement="top"
                  data-bs-custom-class="custom-tooltip tooltip-inner"
                  data-bs-title="Confirmar Pago">
                  <i class="fa-solid fa-arrows-up-down-left-right fa-md"></i>
                </button>
              </div>`;
          } else {
            acciones = `
              <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-info btn-sm"
                  onclick="pregunta(${elemento['id_compra']})"
                  data-bs-toggle-tooltip="tooltip"
                  data-bs-placement="top"
                  data-bs-custom-class="custom-tooltip tooltip-inner"
                  data-bs-title="Confirmar Pago">
                  <i class="fa-solid fa-pen"></i>
                </button>
              </div>`;
          }
          data[i]['contador'] = (i + 1);
          data[i]['sorteo'] = elemento['id_rifa'];
          data[i]['boletos'] = boletos;
          data[i]['acciones'] = acciones;

          if (elemento['estado_pago'] == 'aprobado') {
            data[i]['estado'] = `<div class="btn-group" role="group" aria-label="Estado">
              <button type="button" class="btn btn-success btn-sm" disabled>
              <i class="fa-solid fa-check"></i> Pagado
              </button>
            </div>`;
          } else if (elemento['estado_pago'] == 'rechazado') {
            data[i]['estado'] = `<div class="btn-group" role="group" aria-label="Estado">
              <button type="button" class="btn btn-danger btn-sm" disabled>
              <i class="fa-solid fa-times"></i> Rechazado
              </button>
            </div>`;
          } else {
            data[i]['estado'] = `<div class="btn-group" role="group" aria-label="Estado">
              <button type="button" class="btn btn-info btn-sm" disabled>
              <i class="fa-solid fa-hourglass-half"></i> Pendiente
              </button>
            </div>`;
          }

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
              'data': 'sorteo',
              'title': 'SORTEO',
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

  async function pregunta(id, condition = false) {

    const response = await fetch('./admin/views/compra/accions_view?acvi=' + id, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
    });
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const htmlPersonalizado = await response.text();

    if (condition == 'aprobado') {
      Swal.fire({
        title: '<h5><span class="pago-confirmado">Pago Confirmado<span class="icono-confirmado"></span><i class="fa-solid fa-check-circle"></i></span></h5>',
        html: htmlPersonalizado,
        showCloseButton: true,
        focusConfirm: false,
        confirmButtonText: `
        cerrar`,
      });
      return;
    }
    if (condition == 'rechazado') {
      Swal.fire({
        title: '<h5><span class="pago-rechazado">Pago Rechazado<span class="icono-rechazado"></span><i class="fa-solid fa-circle-xmark"></i></span></h5>',
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
        Swal.fire({
          title: "¡Procesando!",
          html: "Por favor, espera mientras se completa la operación...",
          timerProgressBar: true,
          didOpen: () => {
            Swal.showLoading();

            fetch("./api/change_purchase_status?est=enabled&id=" + id, {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json'
                }
              })
              .then(response => response.json())
              .then(data => {
                Swal.close();

                let timerInterval;
                Swal.fire({
                  icon: 'success',
                  title: '¡Éxito al aceptar!',
                  timer: 3000,
                  timerProgressBar: true,
                  didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                      if (timer) timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                  },
                  willClose: () => {
                    clearInterval(timerInterval);
                    window.location.reload();
                  }
                }).then((result) => {
                  if (result.dismiss === Swal.DismissReason.timer) {
                    // No action needed
                  }
                });

              })
              .catch((error) => {
                Swal.close();
                console.error('Error en la petición:', error);
                Swal.fire({
                  icon: 'error',
                  title: '¡Error!',
                  text: 'Hubo un problema al procesar la solicitud.',
                  timer: 3000,
                  showConfirmButton: false
                });
              });

          },
        });
      } else if (result.isDenied) {
        Swal.fire({
          title: "¡Procesando!",
          html: "Por favor, espera mientras se completa la operación...",
          timerProgressBar: true,
          didOpen: () => {
            Swal.showLoading();
            fetch("./api/change_purchase_status?est=disabled&id=" + id, {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json'
                }
              })
              .then(response => response.json())
              .then(data => {
                Swal.close();
                let timerInterval;
                Swal.fire({
                  icon: 'warning',
                  title: '¡Éxito al rechazar!',
                  timer: 3000,
                  timerProgressBar: true,
                  didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                      if (timer) timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                  },
                  willClose: () => {
                    clearInterval(timerInterval);
                    window.location.reload();
                  }
                }).then((result) => {
                  if (result.dismiss === Swal.DismissReason.timer) {
                    // No action needed
                  }
                });
              })
              .catch((error) => {
                Swal.close();
                console.error('Error en la petición:', error);
                Swal.fire({
                  icon: 'error',
                  title: '¡Error!',
                  text: 'Hubo un problema al procesar la solicitud.',
                  timer: 3000,
                  showConfirmButton: false
                });
              });
          },
        });

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

  .pago-rechazado {
    background-color: #f8d7da;
    /* rojo claro de fondo */
    color: #842029;
    margin: 20px 0px -20px;
    /* rojo oscuro del texto */
    padding: 10px 20px;
    /* Espacio interior */
    border-radius: 5px;
    /* Bordes redondeados */
    border: 1px solid #f5c2c7;
    /* Borde sutil */
    display: inline-block;
    /* Para que el ancho se ajuste al contenido */
    font-weight: bold;
    /* Texto en negrita */
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
  }

  .pago-confirmado {
    background-color: #d4edda;
    /* Verde claro de fondo */
    color: #155724;
    margin: 20px 0px -20px;
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

  .icono-rechazado {
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