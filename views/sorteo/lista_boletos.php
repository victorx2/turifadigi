<link rel="stylesheet" href="assets/css/boletos.css">
<link rel="stylesheet" href="assets/css/chip_alzar.css">

<style>
  /*   .location-options { */
  /*     margin-bottom: 15px; */
  /*     display: flex; */
  /*     gap: 20px; */
  /*   } */
  /*  */
  /*   .location-options label { */
  /*     display: flex; */
  /*     align-items: center; */
  /*     gap: 8px; */
  /*     cursor: pointer; */
  /*   } */
  /*  */
  /*   .location-options input[type="radio"] { */
  /*     cursor: pointer; */
  /*   } */
  /*  */
  /*   .ui.search.dropdown { */
  /*     width: 100%; */
  /*     margin-top: 10px; */
  /*   } */
  /*  */
  /*   .ui.search.dropdown .menu { */
  /*     max-height: 200px; */
  /*     overflow-y: auto; */
  /*   } */
  /*  */
  /*   .ui.dropdown .menu .header { */
  /*     font-weight: bold; */
  /*     color: #2185d0; */
  /*     padding: 8px 16px; */
  /*     background-color: #f8f9fa; */
  /*   } */
</style>

<?php require_once 'views/sorteo/main_slider.php'; ?>
<?php require_once 'premio.php'; ?>

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

      <?php /* require_once 'views/sorteo/celular.php'; */ ?>

      <div class="form-group-custom">
        <label class="required">Celular</label>
        <div class="phone-group" style="display: flex; gap: 10px; align-items: center;">
          <div id="prefijo-dropdown" class="ui search dropdown" data-silent="true">
            <input type="hidden" name="prefijo">
            <div class="default text">Seleccione prefijo</div>
            <i class="dropdown icon"></i>
            <div class="menu" style="display: none;" data-attached="true">
              <div class="item" data-value="VE +58">VE +58</div>
              <div class="item" data-value="US +1">US +1</div>
              <div class="item" data-value="MX +52">MX +52</div>
              <div class="item" data-value="CO +57">CO +57</div>
              <div class="item" data-value="ES +34">ES +34</div>
              <div class="item" data-value="AR +54">AR +54</div>
              <div class="item" data-value="PE +51">PE +51</div>
              <div class="item" data-value="CL +56">CL +56</div>
              <div class="item" data-value="EC +593">EC +593</div>
              <div class="item" data-value="DO +1">DO +1</div>
              <div class="item" data-value="CA +1">CA +1</div>
              <div class="item" data-value="BZ +501">BZ +501</div>
              <div class="item" data-value="CR +506">CR +506</div>
              <div class="item" data-value="SV +503">SV +503</div>
              <div class="item" data-value="GT +502">GT +502</div>
              <div class="item" data-value="HN +504">HN +504</div>
              <div class="item" data-value="NI +505">NI +505</div>
              <div class="item" data-value="PA +507">PA +507</div>
              <div class="item" data-value="AG +1">AG +1</div>
              <div class="item" data-value="BS +1">BS +1</div>
              <div class="item" data-value="BB +1">BB +1</div>
              <div class="item" data-value="CU +53">CU +53</div>
              <div class="item" data-value="DM +1">DM +1</div>
              <div class="item" data-value="GD +1">GD +1</div>
              <div class="item" data-value="HT +509">HT +509</div>
              <div class="item" data-value="JM +1">JM +1</div>
              <div class="item" data-value="KN +1">KN +1</div>
              <div class="item" data-value="LC +1">LC +1</div>
              <div class="item" data-value="VC +1">VC +1</div>
              <div class="item" data-value="TT +1">TT +1</div>
              <div class="item" data-value="BO +591">BO +591</div>
              <div class="item" data-value="BR +55">BR +55</div>
              <div class="item" data-value="GY +592">GY +592</div>
              <div class="item" data-value="PY +595">PY +595</div>
              <div class="item" data-value="SR +597">SR +597</div>
              <div class="item" data-value="UY +598">UY +598</div>
            </div>
            <input type="text" class="search" placeholder="">
          </div>
          <input type="tel" class="form-control-custom" id="telefono" placeholder="0416-3829342" style="width: 700px;" maxlength="11">
        </div>
      </div>

      <!--  -->
      <?php require_once 'views/sorteo/ubicaciones.php'; ?>
      <!--  -->

    </div>

    <div class="payment-section">
      <div class="payment-title">
        <i class="fas fa-money-bill"></i>
        MODOS DE PAGO
      </div>
      <div class="payment-subtitle">Transferencia o depósito</div>

      <div class="payment-methods">
        <div class="payment-method active">
          <img src="assets/img/backgrounds/pagomovilmini.png" alt="Pago Móvil">
        </div>
        <div class="payment-method">
          <img src="assets/img/backgrounds/zellemini.png" alt="Zelle">
        </div>
        <div class="payment-method">
          <img src="assets/img/backgrounds/nesquimini.png" alt="Nesqui">
        </div>
        <div class="payment-method">
          <img src="assets/img/backgrounds/paypalmini.webp" alt="Paypal">
        </div>
        <div class="payment-method">
          <img src="assets/img/backgrounds/vzlamini.png" alt="Banco de Venezuela">
        </div>
        <div class="payment-method">
          <img src="assets/img/backgrounds/bancocolombia.png" alt="Colombia">
        </div>
        <!-- Más métodos de pago aquí -->
      </div>

      <div class="payment-info">
        <p>PAGO MÓVIL</p>
        <p class="subtitle">Cuenta a Consultar</p>
      </div>

      <div class="converter-container">
        <h3 class="text-center">Conversor USD a BS</h3>
        <div class="converter-controls">
          <button class="btn-circle-custom">-</button>
          <input type="text" value="1" readonly>
          <button class="btn-circle-custom">+</button>
        </div>

        <div class="currency-options">
          <label class="currency-option">
            <input type="radio" name="currency" value="BS" checked> BS
          </label>
          <label class="currency-option">
            <input type="radio" name="currency" value="COP"> COP
          </label>
        </div>

        <div class="conversion-result">
          <div class="amount">
            <span>USD</span>
            <span>40.00</span>
          </div>
          <div class="amount">
            <span>BS</span>
            <span>4252.40</span>
          </div>
        </div>
        <p class="exchange-rate">Tasa de cambio: 1 USD = 106.31 BS</p>
      </div>
    </div>

    <div class="form-section">
      <h2 class="form-section-title">
        <i class="fas fa-file-invoice"></i>
        COMPROBANTE DE PAGO
      </h2>
      <p class="form-section-subtitle">Foto o Captura de Pantalla</p>

      <div class="upload-section">
        <button class="btn-upload">
          <i class="fas fa-upload"></i>
          Foto/Captura de Pantalla
        </button>
      </div>

      <div class="form-group-custom">
        <label class="required">Titular</label>
        <input type="text" class="form-control-custom" id="titular">
      </div>

      <div class="form-group-custom">
        <label class="required">Referencia de pago (Últimos 4 dígitos)</label>
        <input type="text" class="form-control-custom" id="referencia">
      </div>

      <div class="form-group-custom">
        <label>Método de pago</label>
        <select class="form-control-custom" id="metodoPago">
          <option value="Banco de venezuela">Banco de Venezuela</option>
        </select>
      </div>
    </div>

    <button type="submit" class="btn-confirmar">CONFIRMAR</button>
  </div>
</div>


<link rel="stylesheet" href="assets/css/buscar_boletos.css">
<link rel="stylesheet" href="assets/css/datos_personales.css">

<div class="loading">Cargando boletos...</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const boletosSeleccionados = new Set();
    const minBoletos = 2;
    let cantidadSeleccion = 2;
    const tasaUSD = 106.31;
    let precioUnitarioUSD = 3;
    const todosLosBoletos = [];
    let cargandoBoletos = false;
    const boletosPorPagina = 500; // Aumentamos la cantidad por página
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

    // Manejadores para los botones + y -
    btnMenos.addEventListener('click', () => {
      if (cantidadSeleccion > minBoletos) {
        cantidadSeleccion--;
        numeroBoletosSpan.textContent = cantidadSeleccion;
        actualizarTotal();
      }
    });

    btnMas.addEventListener('click', () => {
      if (cantidadSeleccion < 10000) { // Aumentado a 10000 boletos máximo
        cantidadSeleccion++;
        numeroBoletosSpan.textContent = cantidadSeleccion;
        actualizarTotal();
      }
    });

    // Función para actualizar el total en USD
    function actualizarTotal() {
      const totalUSD = boletosSeleccionados.size * precioUnitarioUSD;
      const totalBS = totalUSD * tasaUSD;

      // Actualizar el total en USD en el contador
      const totalUSDDisplay = document.getElementById('totalUSD');
      if (totalUSDDisplay) {
        totalUSDDisplay.textContent = `${totalUSD.toFixed(2)} USD`;
      }

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

      // Validar campos requeridos
      const nombre = document.getElementById('nombre').value.trim();
      const cedula = document.getElementById('cedula').value.trim();
      const telefono = document.getElementById('telefono').value.trim();
      const ubicacion = document.getElementById('ubicacion').value.trim();
      const titular = document.getElementById('titular').value.trim();
      const referencia = document.getElementById('referencia').value.trim();
      const metodoPago = document.getElementById('metodoPago').value;

      if (!nombre || !cedula || !telefono || !ubicacion || !titular || !referencia) {
        alert('Por favor complete todos los campos requeridos');
        return;
      }

      const totalUSD = boletosSeleccionados.size * precioUnitarioUSD;
      const totalBS = totalUSD * tasaUSD;

      try {
        // Primero procesamos la compra
        const datosCompra = {
          boletos: Array.from(boletosSeleccionados),
          nombre: nombre,
          cedula: cedula,
          telefono: telefono,
          ubicacion: ubicacion,
          total: totalBS,
          titular: titular,
          referencia: referencia,
          metodo_pago: metodoPago
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
          // Después de procesar la compra, verificamos la disponibilidad
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

    //// Manejo de los radio buttons para ubicación
    //const locationRadios = document.querySelectorAll('input[name="location_type"]');
    //const venezuelaDropdown = document.getElementById('venezuela-dropdown');
    //const paisesDropdown = document.getElementById('paises-dropdown');
    //
    //// Inicializar los dropdowns de Semantic UI
    //$('.ui.dropdown').dropdown();
    //
    //// Función para manejar el cambio de radio button
    //function handleLocationChange(e) {
    //  if (e.target.value === 'venezuela') {
    //    venezuelaDropdown.style.display = 'block';
    //    paisesDropdown.style.display = 'none';
    //  } else {
    //    venezuelaDropdown.style.display = 'none';
    //    paisesDropdown.style.display = 'block';
    //  }
    //}
    //
    //// Agregar el evento a cada radio button
    //locationRadios.forEach(radio => {
    //  radio.addEventListener('change', handleLocationChange);
    //});
    //
    //// Establecer el estado inicial
    //const initialSelection = document.querySelector('input[name="location_type"]:checked');
    //if (initialSelection) {
    //  handleLocationChange({
    //    target: initialSelection
    //  });
    //}
  });
</script>