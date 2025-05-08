<?php require_once 'views/auth/header.php'; ?>
<!-- Agregar CSS de Toastify -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<!-- Agregar CSS personalizado -->
<link rel="stylesheet" type="text/css" href="assets/css/ToastPersonalizado.css">
<!-- Agregar Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<!-- Estilos personalizados para los iconos del signup -->
<style>
  .icon-signup {
    padding-right: 8px;
    opacity: 0.8;
    font-size: 1.1em;
    vertical-align: middle;
    transition: color 0.2s;
  }

  .icon-signup.nombre {
    color: #2962ff;
  }

  .icon-signup.apellido {
    color: #4173ff;
  }

  .icon-signup.cedula {
    color: #5a85ff;
  }

  .icon-signup.ubicacion {
    color: #7296ff;
  }

  .icon-signup.usuario {
    color: #8aa7ff;
  }

  .icon-signup.password {
    color: #a2b8ff;
  }

  .icon-signup.telefono {
    color: #baccff;
  }

  .icon-signup.correo {
    color: #d1deff;
  }

  /* Estilo de error personalizado para los inputs del signup */
  .input-error-signup {
    border: 2px solid #2962ff !important;
    background: rgba(41, 98, 255, 0.07) !important;
    box-shadow: 0 0 0 3px rgba(41, 98, 255, 0.12);
    transition: all 500ms ease;
  }

  /* Efecto hover/focus para los inputs del signup (diferente al error) */
  .input-hover-signup {
    transition: all 500ms ease;
  }

  .input-hover-signup:focus,
  .input-hover-signup:hover {
    border: 1.5px solid #90caf9;
    background: #f5f8ff;
    box-shadow: 0 0 0 2px rgba(41, 98, 255, 0.08);
    outline: none;
  }
</style>
<!-- Agregar JS de Toastify -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<!-- Agregar JS personalizado -->
<script type="text/javascript" src="assets/js/ToastPersonalizado.js"></script>

<section class="contact-two">
  <div class="contact-two__img-1 wow fadeInLeft" data-wow-delay="300ms">
    <img src="assets/images/resources/contact-two-img-1.png" alt="" class="float-bob-x">
  </div>

  <div class="container">
    <div class="row">
      <div class="col-xl-8">
        <div class="contact-two__left">
          <div class="section-title text-left">
            <div class="section-title__tagline-box">
              <div class="section-title__tagline-shape">

              </div>
              <span class="section-title__tagline"></span>
            </div>
            <h2 class="section-title__title">Registrar Cuenta</h2>
          </div>
          <form id="form-registro" class="contact-two__form" action="registro_usuario" method="post">
            <div class="row">
              <div class="col-xl-6 col-lg-6">
                <label for="nombre_signup" class="form-label" style="font-weight: bold;">
                  <i class="bi bi-person-fill icon-signup nombre"></i> Nombre *
                </label>
                <div class="contact-two__input-box">
                  <input type="text" name="nombre" id="nombre_signup" placeholder="Ingrese su nombre" title="El nombre es requerido" required class="input-hover-signup">
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <label for="apellido_signup" class="form-label" style="font-weight: bold;">
                  <i class="bi bi-person-badge-fill icon-signup apellido"></i> Apellido *
                </label>
                <div class="contact-two__input-box">
                  <input type="text" name="apellido" id="apellido_signup" placeholder="Ingrese su apellido" title="El apellido es requerido" required class="input-hover-signup">
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <label for="cedula_signup" class="form-label" style="font-weight: bold;">
                  <i class="bi bi-card-text icon-signup cedula"></i> Cédula *
                </label>
                <div class="contact-two__input-box">
                  <input type="text" name="cedula" id="cedula_signup" placeholder="Ingrese su cédula" title="La cédula es requerida" required class="input-hover-signup">
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <label for="ubicacion_signup" class="form-label" style="font-weight: bold;">
                  <i class="bi bi-geo-alt-fill icon-signup ubicacion"></i> Ubicación *
                </label>
                <div class="contact-two__input-box">
                  <input type="text" name="ubicacion" id="ubicacion_signup" placeholder="E.J: País, estado, dirección" title="La ubicación es requerida" required class="input-hover-signup">
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <label for="usuario_signup" class="form-label" style="font-weight: bold;">
                  <i class="bi bi-person-circle icon-signup usuario"></i> Nombre de usuario *
                </label>
                <div class="contact-two__input-box">
                  <input type="text" name="usuario" id="usuario_signup" placeholder="Cree un nombre de usuario" title="El nombre de usuario es requerido" required class="input-hover-signup">
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <label for="password_signup" class="form-label" style="font-weight: bold;">
                  <i class="bi bi-lock-fill icon-signup password"></i> Contraseña *
                </label>
                <div class="contact-two__input-box">
                  <input type="text" name="password" id="password_signup" placeholder="Cree una contraseña" title="Debe rellenar el campo contraseña" required style="-webkit-text-security: disc;" class="input-hover-signup">
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <label for="telefono_signup" class="form-label" style="font-weight: bold;">
                  <i class="bi bi-telephone-fill icon-signup telefono"></i> Teléfono *
                </label>
                <div class="contact-two__input-box">
                  <input type="text"
                    name="telefono"
                    id="telefono_signup"
                    placeholder="Ingrese su número de teléfono"
                    maxlength="20"
                    title="El número de teléfono es requerido"
                    required class="input-hover-signup">
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <label for="correo_signup" class="form-label" style="font-weight: bold;">
                  <i class="bi bi-envelope-fill icon-signup correo"></i> Correo electrónico *
                </label>
                <div class="contact-two__input-box">
                  <input type="email"
                    name="correo"
                    id="correo_signup"
                    placeholder="Ingrese su correo electrónico"
                    title="El correo electrónico es requerido"
                    required class="input-hover-signup">
                </div>
              </div>
              <div class="col-xl-12 text-center">
                <div class="contact-two__btn-box">
                  <button type="submit" class="thm-btn contact-two__btn">Registrarme</button>
                </div>
              </div>
            </div>
          </form>

          <div class="result"></div>

          <p class="contact-two__left-text" style="margin-top: 20px;">¿Ya tienes una cuenta? &nbsp;&nbsp;&nbsp;<a href="/TuRifadigi/login">Inicia sesión</a></p>

        </div>
      </div>
    </div>
  </div>
</section>

<script>
  // Eliminar todas las validaciones de campos y reglas
  // Solo dejar el envío simple del formulario

  const form = document.getElementById('form-registro');
  let isSubmitting = false;

  form.addEventListener('submit', async function(event) {
    event.preventDefault();
    console.log('Formulario enviado (sin validaciones)');
    if (isSubmitting) return;
    isSubmitting = true;
    const submitButton = this.querySelector('button[type="submit"]');
    submitButton.disabled = true;

    try {
      const formData = new URLSearchParams(new FormData(this));
      console.log('Datos a enviar:', formData.toString());
      const response = await fetch('/TuRifadigi/registro_usuario', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8',
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData.toString(),
        credentials: 'same-origin',
        mode: 'same-origin'
      });

      console.log('Respuesta recibida:', response);
      const data = await response.json();
      console.log('JSON recibido:', data);

      if (!response.ok) throw data;

      showToast('success', 'Éxito', data.message);
      Array.from(form.getElementsByTagName('input')).forEach(input => input.disabled = true);
      console.log('Redirigiendo a /TuRifadigi/login en 2 segundos...');
      setTimeout(() => {
        console.log('Redirigiendo ahora a /TuRifadigi/login');
        window.location.href = '/TuRifadigi/login';
      }, 2000);

    } catch (error) {
      console.error('Error en el catch:', error);
      showToast('error', 'Error', error.message || 'Hubo un error al procesar la solicitud');
    } finally {
      isSubmitting = false;
      submitButton.disabled = false;
      console.log('Finalizó el submit');
    }
  });

  function showToast(type, title, message) {
    switch (type) {
      case 'success':
        ToastPersonalizado.exito(title, message, 5000);
        break;
      case 'error':
        ToastPersonalizado.error(title, message, 5000);
        break;
      case 'warning':
        ToastPersonalizado.advertencia(title, message, 5000);
        break;
      case 'info':
        ToastPersonalizado.info(title, message, 5000);
        break;
    }
  }
</script>

<?php if (!empty($_SESSION['mensaje'])) {
  echo $_SESSION['mensaje'];
  unset($_SESSION['mensaje']);
} ?>

<?php require_once 'views/auth/footer.php'; ?>