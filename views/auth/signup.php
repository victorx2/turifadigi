<?php require_once 'views/layouts/header.php'; ?>
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

  input#password_signup {
    height: 60px;
    width: 100%;
    background-color: var(--zefxa-white);
    padding-left: 30px;
    padding-right: 30px;
    font-size: 14px;
    color: var(--zefxa-gray);
    display: block;
    font-weight: 500;
    line-height: 60px;
    border-width: initial;
    border-style: none;
    border-color: initial;
    border-image: initial;
    outline: none;
    border-radius: 0px;
 }
 .password-toggle {
    position: absolute;
    right: 10px;
    top: 28%;
    cursor: pointer;
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
          <form id="form-registro" class="contact-two__form" action="registro_usuario" method="post" autocomplete=off>
            <div class="row">
              <div class="col-xl-6 col-lg-6">
                <label for="nombre_signup" class="form-label" style="font-weight: bold;">
                  <i class="bi bi-person-fill icon-signup nombre"></i> Nombre *
                </label>
                <div class="contact-two__input-box">
                  <input type="text" name="nombre" id="nombre_signup" placeholder="Ingrese su nombre" class="input-hover-signup">
                  <span id="nombre_signup_msg" style="display:block;font-size:0.95em;color:#e53935;margin-top:2px;"></span>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <label for="apellido_signup" class="form-label" style="font-weight: bold;">
                  <i class="bi bi-person-badge-fill icon-signup apellido"></i> Apellido *
                </label>
                <div class="contact-two__input-box">
                  <input type="text" name="apellido" id="apellido_signup" placeholder="Ingrese su apellido" class="input-hover-signup">
                  <span id="apellido_signup_msg" style="display:block;font-size:0.95em;color:#e53935;margin-top:2px;"></span>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <label for="cedula_signup" class="form-label" style="font-weight: bold;">
                  <i class="bi bi-card-text icon-signup cedula"></i> Cédula *
                </label>
                <div class="contact-two__input-box">
                  <input type="text" name="cedula" id="cedula_signup" placeholder="Ingrese su cédula" class="input-hover-signup">
                  <span id="cedula_signup_msg" style="display:block;font-size:0.95em;color:#e53935;margin-top:2px;"></span>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <label for="ubicacion_signup" class="form-label" style="font-weight: bold;">
                  <i class="bi bi-geo-alt-fill icon-signup ubicacion"></i> Ubicación *
                </label>
                <div class="contact-two__input-box">
                  <input type="text" name="ubicacion" id="ubicacion_signup" placeholder="E.J: País, estado, dirección" class="input-hover-signup">
                  <span id="ubicacion_signup_msg" style="display:block;font-size:0.95em;color:#e53935;margin-top:2px;"></span>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <label for="usuario_signup" class="form-label" style="font-weight: bold;">
                  <i class="bi bi-person-circle icon-signup usuario"></i> Nombre de usuario *
                </label>
                <div class="contact-two__input-box">
                  <input type="text" name="usuario" id="usuario_signup" placeholder="Cree un nombre de usuario" class="input-hover-signup">
                  <span id="usuario_signup_msg" style="display:block;font-size:0.95em;color:#e53935;margin-top:2px;"></span>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <label for="password_signup" class="form-label" style="font-weight: bold;">
                  <i class="bi bi-lock-fill icon-signup password"></i> Contraseña *
                </label>
                <div class="contact-two__input-box" style="position: relative;">
                  <input type="password" name="password" id="password_signup" placeholder="Cree una contraseña" class="input-hover-signup" autocomplete="off">
                  <span class="password-toggle" id="password-togle" onclick="togglePasswordVisibilitySignup()">
                    <i class="bi bi-eye-fill" id="icon-eye-signup"></i>
                  </span>
                  <span id="password_signup_msg" style="display:block;font-size:0.95em;color:#e53935;margin-top:2px;"></span>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <label for="telefono_signup" class="form-label" style="font-weight: bold;">
                  <i class="bi bi-telephone-fill icon-signup telefono"></i> Teléfono *
                </label>
                <div class="contact-two__input-box">
                  <input type="text" name="telefono" id="telefono_signup" placeholder="Ingrese su número de teléfono" class="input-hover-signup">
                  <span id="telefono_signup_msg" style="display:block;font-size:0.95em;color:#e53935;margin-top:2px;"></span>
                </div>
              </div>
              <div class="col-xl-12 text-center">
                <div class="contact-two__btn-box">
                  <button type="submit" class="thm-btn contact-two__btn" id="buttonForm" disabled>Registrarme</button>
                </div>
              </div>
            </div>
          </form>

          <div class="result"></div>

          <p class="contact-two__left-text" style="margin-top: 20px;">¿Ya tienes una cuenta? &nbsp;&nbsp;&nbsp;<a href="/login">Inicia sesión</a></p>

        </div>
      </div>
    </div>
  </div>
</section>
<style>
  button#buttonForm {
    display: inline;
  }
</style>
<script>
  // Eliminar todas las validaciones de campos y reglas
  // Solo dejar el envío simple del formulario

  const form = document.getElementById('form-registro');
  let isSubmitting = false;
  let boton = document.getElementById('buttonForm');

  form.addEventListener('submit', async function(event) {
    event.preventDefault();
    console.log('Formulario enviado (sin validaciones)');
    if (isSubmitting) return;
    isSubmitting = true;
    const submitButton = this.querySelector('button[type="submit"]');
    submitButton.disabled = true;

    try {
      boton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Procesando...';
      boton.disabled = true;

      const formData = new URLSearchParams(new FormData(this));
      console.log('Datos a enviar:', formData.toString());
      const response = await fetch('/registro_usuario', {
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
      console.log('Redirigiendo a /login en 2 segundos...');
      setTimeout(() => {
        console.log('Redirigiendo ahora a /login');
        window.location.href = '/login';
      }, 2000);

    } catch (error) {
      console.error('Error en el catch:', error);
      showToast('error', 'Error', error.message || 'Hubo un error al procesar la solicitud');
      boton.innerHTML = 'Registrarme';
      boton.disabled = false;
    } finally {
      isSubmitting = false;
      submitButton.disabled = false;
      boton.innerHTML = 'Registrarme';
      boton.disabled = false;
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

  // Objeto para almacenar el estado de validación de cada campo
  const estadoValidacionCampos = {
    nombre: false,
    apellido: false,
    cedula: false,
    ubicacion: false,
    usuario: false,
    password: false,
    telefono: false,
  };

  // Función para verificar el estado general de validación
  function verificarEstadoValidacionGeneral() {
    const todosValidos = Object.values(estadoValidacionCampos).every(val => val === true);
    console.log('Estado de validación de campos:', estadoValidacionCampos);
    console.log(todosValidos ? '✅ Todos los campos son válidos' : '❌ Algunos campos no son válidos');
    if (todosValidos) {
      boton.disabled = false;
    }
    return todosValidos;
  }

  const inputNombre = document.getElementById('nombre_signup');
  const spanMsg = document.getElementById('nombre_signup_msg');

  inputNombre.addEventListener('keyup', function() {
    const valor = this.value;
    const esValido = /^[A-Za-zÁÉÍÓÚáéíóúÑñ ]{3,}$/.test(valor);
    estadoValidacionCampos.nombre = esValido;

    if (valor.length === 0) {
      spanMsg.textContent = '';
      spanMsg.style.color = '#e53935';
    } else if (!esValido) {
      spanMsg.textContent = 'El nombre debe tener al menos 3 letras y solo puede contener letras y espacios.';
      spanMsg.style.color = '#e53935';
    } else {
      spanMsg.textContent = '¡Nombre válido!';
      spanMsg.style.color = '#43a047';
    }
    verificarEstadoValidacionGeneral();
  });

  const inputApellido = document.getElementById('apellido_signup');
  const spanMsgApellido = document.getElementById('apellido_signup_msg');

  inputApellido.addEventListener('keyup', function() {
    const valor = this.value;
    const esValido = /^[A-Za-zÁÉÍÓÚáéíóúÑñ ]{3,}$/.test(valor);
    estadoValidacionCampos.apellido = esValido;

    if (valor.length === 0) {
      spanMsgApellido.textContent = '';
      spanMsgApellido.style.color = '#e53935';
    } else if (!esValido) {
      spanMsgApellido.textContent = 'El apellido debe tener al menos 3 letras y solo puede contener letras y espacios.';
      spanMsgApellido.style.color = '#e53935';
    } else {
      spanMsgApellido.textContent = '¡Apellido válido!';
      spanMsgApellido.style.color = '#43a047';
    }
    verificarEstadoValidacionGeneral();
  });

  const inputCedula = document.getElementById('cedula_signup');
  const spanMsgCedula = document.getElementById('cedula_signup_msg');

  inputCedula.addEventListener('keyup', function() {
    const valor = this.value;
    const esValido = /^\d{6,}$/.test(valor);
    estadoValidacionCampos.cedula = esValido;

    if (valor.length === 0) {
      spanMsgCedula.textContent = '';
      spanMsgCedula.style.color = '#e53935';
    } else if (!esValido) {
      spanMsgCedula.textContent = 'La cédula debe tener al menos 6 números y solo puede contener dígitos.';
      spanMsgCedula.style.color = '#e53935';
    } else {
      spanMsgCedula.textContent = '¡Cédula válida!';
      spanMsgCedula.style.color = '#43a047';
    }
    verificarEstadoValidacionGeneral();
  });

  const inputUbicacion = document.getElementById('ubicacion_signup');
  const spanMsgUbicacion = document.getElementById('ubicacion_signup_msg');

  inputUbicacion.addEventListener('keyup', function() {
    const valor = this.value;
    const esValido = /^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9 ,.]{3,}$/.test(valor);
    estadoValidacionCampos.ubicacion = esValido;

    if (valor.length === 0) {
      spanMsgUbicacion.textContent = '';
      spanMsgUbicacion.style.color = '#e53935';
    } else if (!esValido) {
      spanMsgUbicacion.textContent = 'La ubicación debe tener al menos 3 caracteres y solo puede contener letras, espacios, comas y puntos.';
      spanMsgUbicacion.style.color = '#e53935';
    } else {
      spanMsgUbicacion.textContent = '¡Ubicación válida!';
      spanMsgUbicacion.style.color = '#43a047';
    }
    verificarEstadoValidacionGeneral();
  });

  const inputUsuario = document.getElementById('usuario_signup');
  const spanMsgUsuario = document.getElementById('usuario_signup_msg');

  inputUsuario.addEventListener('keyup', function() {
    const valor = this.value;
    const esValido = /^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9_-]{3,}$/.test(valor);
    estadoValidacionCampos.usuario = esValido;

    if (valor.length === 0) {
      spanMsgUsuario.textContent = '';
      spanMsgUsuario.style.color = '#e53935';
    } else if (!esValido) {
      spanMsgUsuario.textContent = 'El nombre de usuario debe tener al menos 3 caracteres y solo puede contener letras, guiones bajos (_) y guiones medios (-).';
      spanMsgUsuario.style.color = '#e53935';
    } else {
      spanMsgUsuario.textContent = '¡Nombre de usuario válido!';
      spanMsgUsuario.style.color = '#43a047';
    }
    verificarEstadoValidacionGeneral();
  });

  const inputPassword = document.getElementById('password_signup');
  const spanMsgPassword = document.getElementById('password_signup_msg');
  const eyefcor = document.getElementById('password-togle');
  inputPassword.addEventListener('keyup', function() {
    const valor = this.value;
    const longitudValida = valor.length >= 8;
    const esValido = longitudValida;
    estadoValidacionCampos.password = esValido;

    if (valor.length > 0) {
      eyefcor.classList.add('password-toggle-correction');
    } else {
      eyefcor.classList.remove('password-toggle-correction');
    }

    if (valor.length === 0) {
      spanMsgPassword.textContent = '';
      spanMsgPassword.style.color = '#e53935';
    } else if (!esValido) {
      spanMsgPassword.textContent = 'La contraseña debe tener al menos 8 caracteres.';
      spanMsgPassword.style.color = '#e53935';
    } else {
      spanMsgPassword.textContent = '¡Contraseña válida!';
      spanMsgPassword.style.color = '#43a047';
    }
    verificarEstadoValidacionGeneral();
  });

  const inputTelefono = document.getElementById('telefono_signup');
  const spanMsgTelefono = document.getElementById('telefono_signup_msg');

  inputTelefono.addEventListener('keyup', function() {
    const valor = this.value;
    const esValido = /^\d{10,}$/.test(valor);
    estadoValidacionCampos.telefono = esValido;

    if (valor.length === 0) {
      spanMsgTelefono.textContent = '';
      spanMsgTelefono.style.color = '#e53935';
    } else if (!esValido) {
      spanMsgTelefono.textContent = 'El teléfono debe tener al menos 10 números y solo puede contener dígitos.';
      spanMsgTelefono.style.color = '#e53935';
    } else {
      spanMsgTelefono.textContent = '¡Teléfono válido!';
      spanMsgTelefono.style.color = '#43a047';
    }
    verificarEstadoValidacionGeneral();
  });

  // Función para alternar visibilidad de la contraseña en el signup
  function togglePasswordVisibilitySignup() {
    const passwordInput = document.getElementById('password_signup');
    const icon = document.getElementById('icon-eye-signup');
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      icon.classList.remove('bi-eye-fill');
      icon.classList.add('bi-eye-slash-fill');
    } else {
      passwordInput.type = 'password';
      icon.classList.remove('bi-eye-slash-fill');
      icon.classList.add('bi-eye-fill');
    }
  }
</script>

<?php if (!empty($_SESSION['mensaje'])) {
  echo $_SESSION['mensaje'];
  unset($_SESSION['mensaje']);
} ?>

<style>
 .password-toggle-correction{
    position: absolute;
    right: 10px;
    top: 14%;
    cursor: pointer;
 }
</style>


<?php require_once 'views/layouts/footer.php'; ?>