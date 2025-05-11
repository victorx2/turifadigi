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
      <h1 style="color: #5497CC;" class=" text-center">Administración de Sorteos</h1>
      <h5 class=" text-center"> <strong>- Gestión de Sorteos activar/finalizar -</strong> </h5>
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
            <th class="text-center bg-body-tertiary" width="20%">FECHA DE CREACION</th>
            <th class="text-center bg-body-tertiary" width="25%">TITULO</th>
            <th class="text-center bg-body-tertiary" width="10%">ID SORTEO</th>
            <th class="text-center bg-body-tertiary" width="20%">BOLETOS MAXIMOS</th>
            <th class="text-center bg-body-tertiary" width="10%">PRECIO BOLETO</th>
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

  fetch('./api/get_sorteo?cmp=1', {
      method: 'POST',
      header: {
        'Content-Type': 'application/json'
      }
    }).then(response => response.json())
    .then(dataD => {
      if (dataD.success) {

        let i = 0;
        let data = dataD.data;

        console.log("Datos recibidos de la API:", dataD); // Log de los datos recibidos

        data.forEach((elemento, index) => {
          let acciones = `<div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-info btn-sm" onclick="obsSorteo(${elemento['id_rifa']})" data-bs-toggle-tooltip="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip tooltip-inner" data-bs-title="Editar Sorteo">
                           <i class="fa-solid fa-arrows-up-down-left-right fa-md"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="cambiarEstado(${elemento['id_rifa']})" data-bs-toggle-tooltip="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip tooltip-inner" data-bs-title="Cambiar Estado">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                    </div>`;

          data[i]['contador'] = (i + 1);
          data[i]['id_rifa'] = elemento['id_rifa'];
          data[i]['titulo'] = elemento['titulo'];
          data[i]['fecha_creacion'] = elemento['fecha_creacion'];
          data[i]['boletos_maximos'] = elemento['configuracion']['boletos_maximos'];
          data[i]['precio_boleto'] = elemento['configuracion']['precio_boleto'];
          data[i]['estado'] = elemento['estado'];
          data[i]['acciones'] = acciones;

          console.log(`Procesando sorteo ${i+1}:`, data[i]); // Log de cada sorteo procesado
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
              'data': 'fecha_creacion',
              'title': 'FECHA DE CREACION',
              'className': 'text-center'
            },
            {
              'data': 'titulo',
              'title': 'TITULO',
              'className': 'text-center'
            },
            {
              'data': 'id_rifa',
              'title': 'ID SORTEO',
              'className': 'text-center'
            },
            {
              'data': 'boletos_maximos',
              'title': 'BOLETOS MAXIMOS',
              'className': 'text-center'
            },
            {
              'data': 'precio_boleto',
              'title': 'PRECIO BOLETO',
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

        console.log("Datos preparados para la tabla:", datos); // Log de los datos finales
        cargar_tabla_boletos(datos);

      } else {
        console.error('Error al cargar los datos de la tabla:', data.error);
      }
    })
    .catch(error => console.error('Error:', error));

  // FUNCION PARA CAMBIAR ESTADO DEL SORTEO

  async function cambiarEstado(id) {
    Swal.fire({
      title: 'Cambio de estado',
      text: 'Al activar este sorteo, se desactivarán automáticamente los demás sorteos activos. ¿Deseas continuar?',
      showCloseButton: true,
      showCancelButton: true,
      showDenyButton: true,
      focusConfirm: false,
      confirmButtonText: `
              activar`,
      denyButtonText: `
              finalizar`,
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

            fetch("./api/change_draw_status?est=enabled&id=" + id, {
                method: 'POST', // O el método HTTP que necesites
                headers: {
                  'Content-Type': 'application/json'
                }
              })
              .then(response => response.json()) // O response.text() si esperas texto plano
              .then(data => {
                Swal.close(); // Cierra el SweetAlert de "Procesando"

                let timerInterval;
                Swal.fire({
                  icon: 'success', // 'success' O 'error', 'warning', 'info', 'question' según el resultado
                  title: '¡Éxito al activar!', // O el título que corresponda
                  timer: 3000,
                  timerProgressBar: true,
                  didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                      timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                  },
                  willClose: () => {
                    clearInterval(timerInterval);
                    window.location.href = '/TuRifadigi/sorteo_verificacion';
                  }
                }).then((result) => {
                  /* Read more about handling dismissals below */
                  if (result.dismiss === Swal.DismissReason.timer) {
                    console.log("I was closed by the timer");
                  }
                });

              })
              .catch((error) => {
                Swal.close(); // Asegúrate de cerrar el SweetAlert de "Procesando" en caso de error
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

        // window.location.href = "/TuRifadigi/confirmarBoleto/" + id;
      } else if (result.isDenied) {
        Swal.fire({
          title: "¡Procesando!",
          html: "Por favor, espera mientras se completa la operación...",
          timerProgressBar: true,
          didOpen: () => {
            Swal.showLoading();

            fetch("./api/change_draw_status?est=disabled&id=" + id, {
                method: 'POST', // O el método HTTP que necesites
                headers: {
                  'Content-Type': 'application/json'
                }
              })
              .then(response => response.json()) // O response.text() si esperas texto plano
              .then(data => {
                Swal.close(); // Cierra el SweetAlert de "Procesando"

                let timerInterval;
                Swal.fire({
                  icon: 'info', // 'success' O 'error', 'warning', 'info', 'question' según el resultado
                  title: '¡Éxito al finalizar!', // O el título que corresponda
                  timer: 3000,
                  timerProgressBar: true,
                  didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                      timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                  },
                  willClose: () => {
                    clearInterval(timerInterval);
                    window.location.href = '/TuRifadigi/sorteo_verificacion';
                  }
                }).then((result) => {
                  /* Read more about handling dismissals below */
                  if (result.dismiss === Swal.DismissReason.timer) {
                    console.log("I was closed by the timer");
                  }
                });

              })
              .catch((error) => {
                Swal.close(); // Asegúrate de cerrar el SweetAlert de "Procesando" en caso de error
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

    // const response = await fetch('./admin/views/sorteo/cambiar_estado?id=' + id, {
    //   method: 'POST',
    //   headers: {
    //     'Content-Type': 'application/json'
    //   },
    // });

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const result = await response.json();
    console.log("Resultado del cambio de estado:", result); // Log del resultado

    if (result.success) {
      Swal.fire({
        title: 'Estado actualizado',
        text: 'El estado del sorteo ha sido modificado correctamente',
        icon: 'success',
        confirmButtonText: 'Aceptar'
      }).then(() => {
        location.reload();
      });
    } else {
      Swal.fire({
        title: 'Error',
        text: result.message,
        icon: 'error',
        confirmButtonText: 'Aceptar'
      });
    }
  }

  // FUNCION PARA VER DETALLES DEL SORTEO
  async function obsSorteo(id, condition = false) {
    console.log(`Obteniendo detalles del sorteo ID: ${id}`); // Log de la acción
    try {
      const response = await fetch('./admin/views/sorteo/only_view?acvi=' + id, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
      });

      if (!response.ok) {
        throw new Error(`Error HTTP! estado: ${response.status}`);
      }

      const htmlPersonalizado = await response.text();
      console.log("HTML recibido para vista de acciones:", htmlPersonalizado); // Log del HTML recibido

      Swal.fire({
        html: htmlPersonalizado,
        showCloseButton: true,
        focusConfirm: false,
        confirmButtonText: 'cerrar',
        showCancelButton: false,
        width: '800px'
      });

      return;

    } catch (error) {
      console.error('Error al obtener los detalles:', error);
      Swal.fire({
        title: 'Error',
        text: 'No se pudieron obtener los detalles del sorteo',
        icon: 'error',
        confirmButtonText: 'Aceptar'
      });
    }
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