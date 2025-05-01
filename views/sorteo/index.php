<link rel="stylesheet" href="assets/css/boletos.css">
<link rel="stylesheet" href="assets/css/chip_alzar.css">


<div class="container-fluid">
  <div class="text-center">
    <h1 class="lista-title">LISTA DE BOLETOS</h1>

    <div class="elegir-title">
      <button id="btnRandomNumber" class="magic-button">
        <i class="fa fa-star"></i>
        <span>ELEGIR A LA SUERTE</span>
        <i class="fa fa-star"></i>
      </button>
    </div>

    <div class="contador-boletos">
      <button class="btn-circle">-</button>
      <span class="numero-boletos">2</span>
      <button class="btn-circle">+</button>
      <div class="total">Total: <span id="totalUSD">12 USD</span></div>
    </div>

    <div class="buscar-container">
      <input type="text" id="buscador" class="form-control" placeholder="Buscar boleto (ej: 001, 0020...)">
      <button class="btn-buscar">BUSCAR</button>
    </div>

    <div class="boletos-container">
      <div class="boletos-grid" id="boletosList">
        <!-- Los boletos se generarán dinámicamente aquí -->
      </div>
      <div class="loading-text">Cargando más boletos...</div>
    </div>

    <div class="seleccionados-container" style="display: none;">
      <span class="seleccionados-text">SELECCIONADOS</span>
      <div class="contador">0</div>
      <div class="boletos-seleccionados-chips"></div>
      <button class="btn-continuar">CONTINUAR</button>
    </div>
  </div>

  <div id="datosPersonales" class="form-personal" style="display: none;">
    <div class="total-info">
      Total: <span id="totalBSDisplay">4252.40 BS</span> (1 boletos)
    </div>
    <div class="form-section">
      <h2 class="form-section-title">
        <i class="fas fa-user"></i>
        DATOS PERSONALES
      </h2>
      <div class="form-group-custom">
        <label class="required">Nombres y Apellidos</label>
        <input type="text" class="form-control-custom" id="nombre" placeholder="Nombre Apellido">
      </div>
      <div class="form-group-custom">
        <label class="required">Cédula</label>
        <input type="text" class="form-control-custom" id="cedula" placeholder="9384235">
      </div>
      <?php require_once 'views/sorteo/celular.php'; ?>
      <?php require_once 'views/sorteo/ubicaciones.php'; ?>
    </div>
    <?php require_once 'views/sorteo/modo_de_pago.php'; ?>
    <?php require_once 'views/sorteo/comprobante_de_pago.php'; ?>
    <button type="submit" class="btn-confirmar">CONFIRMAR</button>
  </div>
</div>


<link rel="stylesheet" href="assets/css/buscar_boletos.css">
<link rel="stylesheet" href="assets/css/datos_personales.css">

<div class="loading">Cargando boletos...</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Configuración global para Semantic UI Transitions
    $.fn.transition.settings.silent = true;

    // Inicializar el dropdown con configuración optimizada
    const $dropdown = $('#payment-method-dropdown').dropdown({
      onChange: function(value, text, $selectedItem) {
        mostrarDatosPago(value);
      },
      // Desactivar animaciones y transiciones
      transition: 'none',
      duration: 0,
      animation: 'none',
      // Configuración adicional para evitar problemas de DOM
      allowReselection: true,
      forceSelection: false,
      selectOnKeydown: false,
      fullTextSearch: false,
      // Evitar que el menú se oculte automáticamente
      hideOnScroll: false,
      allowTab: false,
      // Configuración de rendimiento
      throttle: 0,
      // Configuración de búsqueda
      match: 'text',
      preserveHTML: false,
      sortSelect: false,
      // Configuración de visualización
      direction: 'auto',
      keepOnScreen: true
    });

    // Asegurarse de que el dropdown esté visible
    $dropdown.css({
      'display': 'block',
      'visibility': 'visible',
      'opacity': '1'
    });

    // Función para mostrar los detalles del método de pago seleccionado
    function mostrarDatosPago(metodo) {
      const paymentTitle = document.getElementById('paymentTitle');
      const paymentDetails = document.getElementById('paymentDetails');

      if (!paymentTitle || !paymentDetails) return;

      switch (metodo) {
        case 'zelle':
          paymentTitle.textContent = 'ZELLE';
          paymentDetails.innerHTML = `
            <p class="subtitle">Datos de la cuenta</p>
            <p>Número de teléfono: +1 4074287580</p>
          `;
          break;

        case 'paypal':
          paymentTitle.textContent = 'PAYPAL';
          paymentDetails.innerHTML = `
            <p class="subtitle">Datos de la cuenta</p>
            <p>Nombre: Yorsin Cruz Osorio</p>
            <p>Correo Electrónico: Yorsincruz1995@gmail.com</p>
            <p>Usuario: @Yorsin0506</p>
            <p>Número teléfono: +1 4074287580</p>
          `;
          break;

        case 'banco_venezuela':
          paymentTitle.textContent = 'BANCO DE VENEZUELA';
          paymentDetails.innerHTML = `
            <p class="subtitle">Datos de la cuenta</p>
            <p>Número de teléfono: 04124124923</p>
            <p>Cédula de identidad: 28517267</p>
          `;
          break;
      }
    }

    const boletosSeleccionados = new Set();
    const minBoletos = 2;
    let cantidadSeleccion = 2;
    const tasaUSD = 106.31;
    let precioUnitarioUSD = 3;
    const todosLosBoletos = [];
    let cargandoBoletos = false;
    const boletosPorPagina = 500;
    const totalBoletos = 10000;

    // Referencias a elementos del DOM
    const boletosContainer = document.querySelector('.boletos-container');
    const boletosList = document.getElementById('boletosList');
    const loadingText = document.querySelector('.loading-text');
    const buscador = document.getElementById('buscador');
    const btnRandomNumber = document.getElementById('btnRandomNumber');
    const numeroBoletosSpan = document.querySelector('.numero-boletos');
    const totalUSDSpan = document.getElementById('totalUSD');
    const btnMenos = document.querySelector('.btn-circle:first-of-type');
    const btnMas = document.querySelector('.btn-circle:last-of-type');

    function debounce(func, wait) {
      let timeout;
      return function executedFunction(...args) {
        const later = () => {
          clearTimeout(timeout);
          func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
      };
    }

    // Función para cargar más boletos
    async function cargarMasBoletos() {
      if (cargandoBoletos || todosLosBoletos.length >= totalBoletos) return;

      cargandoBoletos = true;
      loadingText.classList.add('visible');

      const inicio = todosLosBoletos.length + 1;
      const fin = Math.min(inicio + boletosPorPagina - 1, totalBoletos);

      const fragment = document.createDocumentFragment();
      for (let i = inicio; i <= fin; i++) {
        const numero = i.toString().padStart(4, '0');
        const boleto = document.createElement('div');
        boleto.className = 'boleto';
        boleto.textContent = numero;
        boleto.dataset.numero = numero;
        boleto.onclick = function() {
          toggleBoleto(this, numero);
        };
        fragment.appendChild(boleto);
        todosLosBoletos.push(boleto);
      }

      boletosList.appendChild(fragment);

      setTimeout(() => {
        cargandoBoletos = false;
        loadingText.classList.remove('visible');
      }, 300);

      // Mostrar mensaje cuando se hayan cargado todos los boletos
      if (todosLosBoletos.length >= totalBoletos) {
        loadingText.textContent = 'Has llegado al final de la lista';
        loadingText.classList.add('visible');
        setTimeout(() => loadingText.classList.remove('visible'), 2000);
      }
    }

    // Manejador del scroll del contenedor
    function handleScroll() {
      const {
        scrollTop,
        scrollHeight,
        clientHeight
      } = boletosContainer;
      if (scrollHeight - scrollTop - clientHeight < 300) {
        cargarMasBoletos();
      }
    }

    // Agregar el evento de scroll al contenedor
    boletosContainer.addEventListener('scroll', handleScroll);

    // Cargar los primeros boletos
    cargarMasBoletos();

    // Inicializar el contador y total
    numeroBoletosSpan.textContent = cantidadSeleccion;
    actualizarTotal();
    actualizarContador();

    // Manejadores para los botones + y -
    btnMenos.addEventListener('click', () => {
      if (cantidadSeleccion > minBoletos) {
        cantidadSeleccion--;
        numeroBoletosSpan.textContent = cantidadSeleccion;
        actualizarTotal();
        actualizarContador();
      }
    });

    btnMas.addEventListener('click', () => {
      if (cantidadSeleccion < 10000) {
        cantidadSeleccion++;
        numeroBoletosSpan.textContent = cantidadSeleccion;
        actualizarTotal();
        actualizarContador();
      }
    });

    // Función para actualizar el total en USD
    function actualizarTotal() {
      const totalUSD = cantidadSeleccion * precioUnitarioUSD;
      const totalBS = totalUSD * tasaUSD;

      // Actualizar el total en USD en el contador
      totalUSDSpan.textContent = `${totalUSD} USD`;

      // Actualizar el total en BS en el formulario de datos personales
      const totalBSDisplay = document.getElementById('totalBSDisplay');
      if (totalBSDisplay) {
        totalBSDisplay.textContent = `${totalBS.toFixed(2)} BS`;
      }
    }

    // Función para actualizar los chips de boletos seleccionados
    function actualizarChipsBoletos() {
      const contenedor = document.querySelector('.boletos-seleccionados-chips');
      contenedor.innerHTML = '';

      Array.from(boletosSeleccionados).sort().forEach(numero => {
        const chip = document.createElement('div');
        chip.className = 'boleto-chip';

        const numeroSpan = document.createElement('span');
        numeroSpan.textContent = numero;

        const removeButton = document.createElement('button');
        removeButton.className = 'chip-remove';
        removeButton.innerHTML = '×';
        removeButton.onclick = (e) => {
          e.stopPropagation();
          const boleto = document.querySelector(`.boleto[data-numero="${numero}"]`);
          if (boleto) {
            toggleBoleto(boleto, numero);
          }
        };

        chip.appendChild(numeroSpan);
        chip.appendChild(removeButton);
        contenedor.appendChild(chip);
      });

      // Actualizar el contador
      const contador = document.querySelector('.contador');
      contador.textContent = `${boletosSeleccionados.size} de ${cantidadSeleccion}`;
    }

    // Mostrar u ocultar el contenedor de seleccionados
    function toggleSelectedContainer() {
      const contenedor = document.querySelector('.boletos-grid');
      const boletos = contenedor.querySelectorAll('.selected');
      const selectedContainer = document.querySelector('.seleccionados-container');

      if (boletos.length >= 2) {
        selectedContainer.style.display = 'block'; // Hacer visible
      } else {
        selectedContainer.style.display = 'none'; // Hacer invisible
      }
    }

    // Función para alternar selección de boleto
    function toggleBoleto(elemento, numero) {
      if (elemento.classList.contains('selected')) {
        elemento.classList.remove('selected');
        boletosSeleccionados.delete(numero);
      } else {
        elemento.classList.add('selected');
        boletosSeleccionados.add(numero);
      }
      toggleSelectedContainer();
      actualizarContador();
      actualizarTotal();
      actualizarChipsBoletos();
    }

    // Función para elegir boletos al azar
    function elegirBoletosAlAzar() {
      boletosSeleccionados.clear();
      document.querySelectorAll('.boleto.selected').forEach(b => b.classList.remove('selected'));
      document.querySelector('.boletos-seleccionados-chips').innerHTML = ''; // Limpiar chips

      const boletosDisponibles = Array.from(todosLosBoletos).filter(b => !b.classList.contains('disabled'));

      if (boletosDisponibles.length < cantidadSeleccion) {
        alert('No hay suficientes boletos disponibles');
        return;
      }

      for (let i = 0; i < cantidadSeleccion; i++) {
        let indiceAleatorio;
        let boletoSeleccionado;

        do {
          indiceAleatorio = Math.floor(Math.random() * boletosDisponibles.length);
          boletoSeleccionado = boletosDisponibles[indiceAleatorio];
        } while (boletosSeleccionados.has(boletoSeleccionado.dataset.numero));

        setTimeout(() => {
          boletoSeleccionado.classList.add('selected');
          boletosSeleccionados.add(boletoSeleccionado.dataset.numero);
          actualizarContadorSeleccionados();
          actualizarChipsBoletos(); // Actualizar chips con retraso
          toggleSelectedContainer()

        }, i * 200);

        boletosDisponibles.splice(indiceAleatorio, 1);
      }
    }

    // Actualizar el contador de seleccionados
    function actualizarContadorSeleccionados() {
      const contadorElement = document.querySelector('.contador');
      contadorElement.textContent = `${boletosSeleccionados.size} de ${cantidadSeleccion}`;
    }

    // Evento para el botón de elegir a la suerte
    btnRandomNumber.addEventListener('click', elegirBoletosAlAzar);

    // Función de búsqueda en tiempo real
    function filtrarBoletos(busqueda) {
      busqueda = busqueda.trim();

      todosLosBoletos.forEach(boleto => {
        const numeroBoleto = boleto.dataset.numero;
        if (busqueda === '') {
          // Si no hay búsqueda, mostrar todos
          boleto.style.display = '';
          boleto.style.order = ''; // Restaurar orden original
        } else if (numeroBoleto.startsWith(busqueda)) {
          // Si el número coincide con la búsqueda, mostrar
          boleto.style.display = '';
          boleto.style.order = '1'; // Mover al principio
        } else {
          // Si no coincide, ocultar
          boleto.style.display = 'none';
          boleto.style.order = '2';
        }
      });
    }

    // Evento de entrada en el buscador (tiempo real)
    buscador.addEventListener('input', function(e) {
      filtrarBoletos(e.target.value);
    });

    // Evento del botón buscar
    document.querySelector('.btn-buscar').onclick = function() {
      filtrarBoletos(buscador.value);
    };

    // Actualizar el contador de boletos
    function actualizarContador() {
      const contador = document.querySelector('.contador');
      contador.textContent = `${boletosSeleccionados.size} de ${cantidadSeleccion}`;
    }

    // Verificar disponibilidad de boletos seleccionados
    async function verificarBoletosSeleccionados() {
      const boletosArray = Array.from(boletosSeleccionados);
      console.log('Boletos seleccionados para verificar:', boletosArray);

      try {
        const response = await fetch('/TuRifadigi/verificarDisponibilidad', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Cache-Control': 'no-cache'
          },
          body: JSON.stringify({
            boletos: boletosArray
          })
        });

        if (!response.ok) {
          throw new Error(`Error HTTP: ${response.status}`);
        }

        const responseText = await response.text();

        if (!responseText.trim()) {
          throw new Error('Respuesta vacía del servidor');
        }

        const data = JSON.parse(responseText);

        if (!data.disponibles || !Array.isArray(data.disponibles)) {
          throw new Error('Formato de respuesta inválido');
        }

        const boletosNoDisponibles = data.disponibles.filter(b => !b.disponible).map(b => b.numero);

        if (boletosNoDisponibles.length > 0) {
          alert(`Los siguientes boletos no están disponibles: ${boletosNoDisponibles.join(', ')}`);
          return false;
        }

        return true;
      } catch (error) {
        console.error('Error en verificación:', error);
        alert('Error al verificar la disponibilidad de los boletos: ' + error.message);
        return false;
      }
    }

    // Continuar con el proceso
    document.querySelector('.btn-continuar').onclick = function() {
      if (boletosSeleccionados.size < minBoletos) {
        alert('Debe seleccionar al menos 2 boletos para continuar');
        return;
      }
      document.getElementById('datosPersonales').style.display = 'block';
      this.parentElement.style.display = 'none';
    };

    // Manejar el envío del formulario
    document.querySelector('.btn-confirmar').onclick = async function(e) {
      e.preventDefault();

      // Función auxiliar para obtener valor seguro
      const getInputValue = (selector) => {
        const element = document.querySelector(selector);
        return element ? element.value.trim() : '';
      };

      // Obtener valores de forma segura
      const formData = {
        nombre: getInputValue('#nombre'),
        cedula: getInputValue('#cedula'),
        telefono: getInputValue('#telefono'),
        prefijo: $('input[name="prefijo"]').val(),
        estado: $('input[name="estado_venezuela"]').val() || $('input[name="pais_internacional"]').val(),
        titular: getInputValue('#titular'),
        referencia: getInputValue('#referencia'),
        metodoPago: $('input[name="payment_method"]').val()
      };

      // Validar que todos los campos requeridos tengan valor
      const camposRequeridos = [{
          campo: 'nombre',
          mensaje: 'Nombre'
        },
        {
          campo: 'cedula',
          mensaje: 'Cédula'
        },
        {
          campo: 'telefono',
          mensaje: 'Teléfono'
        },
        {
          campo: 'prefijo',
          mensaje: 'Prefijo telefónico'
        },
        {
          campo: 'estado',
          mensaje: 'Ubicación'
        },
        {
          campo: 'titular',
          mensaje: 'Titular'
        },
        {
          campo: 'referencia',
          mensaje: 'Referencia'
        },
        {
          campo: 'metodoPago',
          mensaje: 'Método de pago'
        }
      ];

      const camposFaltantes = camposRequeridos
        .filter(({
          campo
        }) => !formData[campo])
        .map(({
          mensaje
        }) => mensaje);

      if (camposFaltantes.length > 0) {
        alert(`Por favor complete los siguientes campos:\n${camposFaltantes.join('\n')}`);
        return;
      }

      const totalUSD = boletosSeleccionados.size * precioUnitarioUSD;
      const totalBS = totalUSD * tasaUSD;

      try {
        // Preparar datos de la compra
        const datosCompra = {
          boletos: Array.from(boletosSeleccionados),
          ...formData,
          total: totalBS
        };

        const responseCompra = await fetch('/TuRifadigi/procesarCompra', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(datosCompra)
        });

        const dataCompra = await responseCompra.json();

        if (dataCompra.success) {
          // Verificar disponibilidad después de procesar la compra
          const responseVerificacion = await fetch('/TuRifadigi/verificarDisponibilidad', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              boletos: Array.from(boletosSeleccionados)
            })
          });

          const dataVerificacion = await responseVerificacion.json();
          const boletosNoDisponibles = dataVerificacion.disponibles.filter(b => !b.disponible).map(b => b.numero);

          if (boletosNoDisponibles.length > 0) {
            alert(`Los siguientes boletos ya no están disponibles: ${boletosNoDisponibles.join(', ')}`);
            return;
          }

          alert('¡Compra procesada correctamente!');
          window.location.reload();
        } else {
          alert(dataCompra.error || 'Error al procesar la compra');
        }
      } catch (error) {
        console.error('Error:', error);
        alert('Ocurrió un error al procesar la solicitud');
      }
    };

    // Conversor de moneda
    document.querySelectorAll('.conversor-controls .btn-circle-custom').forEach(btn => {
      btn.onclick = function() {
        const input = this.parentElement.querySelector('input');
        const valor = parseInt(input.value);
        if (this.textContent === '+' && valor < 500) {
          input.value = valor + 1;
        } else if (this.textContent === '-' && valor > 1) {
          input.value = valor - 1;
        }
        actualizarTotal();
      };
    });

    // Subir comprobante
    document.querySelector('.btn-upload').onclick = function() {
      const input = document.createElement('input');
      input.type = 'file';
      input.accept = 'image/*';
      input.onchange = function(e) {
        const file = e.target.files[0];
        if (file) {
          console.log('Imagen seleccionada:', file.name);
        }
      };
      input.click();
    };

    // Actualizar estilos para el botón de remover en el chip
    const styles = document.createElement('style');
    styles.textContent = `
      .boleto-chip {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #007bff;
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 14px;
        cursor: pointer;
      }

      .chip-remove {
        background: none;
        border: none;
        color: white;
        font-size: 18px;
        cursor: pointer;
        padding: 0 4px;
        line-height: 1;
        border-radius: 50%;
        transition: background-color 0.2s;
      }

      .chip-remove:hover {
        background-color: rgba(255,255,255,0.2);
      }
    `;
    document.head.appendChild(styles);
  });
</script>
<link rel="stylesheet" href="assets/css/dropdown-search-method.css">


<head>
  <link rel="stylesheet" href="/TuRifadigi/assets/css/payment.css">
  <script src="/TuRifadigi/assets/js/payment.js"></script>
</head>

<style>
  /* Estilos para el grupo de teléfono */
  .phone-group {
    display: flex;
    gap: 10px;
    align-items: stretch;
  }

  .phone-group .ui.dropdown {
    min-height: 45px;
    width: 140px !important;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    display: flex;
    align-items: center;
    padding: 0 15px;
    background: white;
    margin: 0;
  }

  .phone-group .ui.dropdown .text {
    font-size: 14px;
    color: #333;
  }

  .phone-group .ui.dropdown .menu {
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    margin-top: 5px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  .phone-group input[type="tel"] {
    height: 45px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    padding: 0 15px;
    font-size: 14px;
    color: #333;
    flex: 1;
    min-width: 0;
  }

  .phone-group input[type="tel"]:focus {
    border-color: #85b7d9;
    outline: none;
  }

  .phone-group .ui.dropdown:hover,
  .phone-group input[type="tel"]:hover {
    border-color: #ccc;
  }

  .phone-group .ui.dropdown.active {
    border-color: #85b7d9;
  }
</style>