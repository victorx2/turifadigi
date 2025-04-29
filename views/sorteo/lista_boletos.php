<link rel="stylesheet" href="assets/css/boletos.css">
<link rel="stylesheet" href="assets/css/chip_alzar.css">

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
      <span class="numero-boletos">3</span>
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

    <div class="seleccionados-container">
      <span class="seleccionados-text">SELECCIONADOS</span>
      <div class="contador">0 de 3</div>
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

      <div class="form-group-custom">
        <label class="required">Celular</label>
        <div class="phone-group">
          <select class="form-control-custom" id="prefijo">
            <option value="VE +58">VE +58</option>
          </select>
          <input type="tel" class="form-control-custom" id="telefono" placeholder="4163829342">
        </div>
      </div>

      <div class="form-group-custom">
        <label>Ubicación</label>
        <select class="form-control-custom" id="ubicacion">
          <option value="Tachira">Táchira</option>
        </select>
      </div>
    </div>

    <div class="payment-section">
      <div class="payment-title">
        <i class="fas fa-money-bill"></i>
        MODOS DE PAGO
      </div>
      <div class="payment-subtitle">Transferencia o depósito</div>

      <div class="payment-methods">
        <div class="payment-method active">
          <img src="assets/img/pago-movil.png" alt="Pago Móvil">
        </div>
        <div class="payment-method">
          <img src="assets/img/zelle.png" alt="Zelle">
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

<style>
  .loading {
    position: fixed;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    background-color: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 10px 20px;
    border-radius: 20px;
    display: none;
    z-index: 1000;
    font-size: 14px;
  }

  .loading.visible {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .loading::after {
    content: '';
    width: 20px;
    height: 20px;
    border: 2px solid #fff;
    border-top: 2px solid transparent;
    border-radius: 50%;
    animation: spin 1s linear infinite;
  }

  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }

  .boletos-container {
    max-height: calc(100vh - 300px);
    /* Altura ajustable según el viewport */
    overflow-y: auto;
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    margin: 20px auto;
    width: 95%;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }

  .boletos-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(65px, 1fr));
    gap: 8px;
    padding: 10px;
  }

  .boleto {
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    padding: 8px 4px;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 13px;
    color: #333;
  }

  .boleto:hover:not(.disabled) {
    background: #f8f9fa;
    border-color: #007bff;
    transform: translateY(-1px);
  }

  .boleto.selected {
    background: #007bff;
    color: white;
    border-color: #0056b3;
  }

  .boleto.disabled {
    opacity: 0.5;
    cursor: not-allowed;
    background: #f5f5f5;
  }

  /* Estilizar la barra de scroll */
  .boletos-container::-webkit-scrollbar {
    width: 8px;
  }

  .boletos-container::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
  }

  .boletos-container::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 10px;
  }

  .boletos-container::-webkit-scrollbar-thumb:hover {
    background: #555;
  }

  .loading-text {
    position: sticky;
    bottom: 0;
    left: 0;
    right: 0;
    text-align: center;
    padding: 10px;
    background: rgba(255, 255, 255, 0.9);
    color: #666;
    font-size: 14px;
    display: none;
    z-index: 1000;
  }

  .loading-text.visible {
    display: block;
  }

  .seleccionados-container {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: white;
    padding: 20px;
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    z-index: 1000;
  }

  .seleccionados-text {
    font-size: 16px;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
  }

  .contador {
    font-size: 14px;
    color: #666;
    margin: 10px 0;
  }

  .boletos-seleccionados-chips {
    display: flex;
    gap: 10px;
    justify-content: center;
    flex-wrap: wrap;
    margin: 15px 0;
  }

  .boleto-chip {
    display: inline-flex;
    align-items: center;
    background: #007bff;
    color: white;
    padding: 8px 12px;
    border-radius: 20px;
    font-size: 14px;
    gap: 8px;
    cursor: default;
  }

  .chip-remove {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 20px;
    background: rgba(255, 255, 255, 0.3);
    border: none;
    color: white;
    font-size: 16px;
    cursor: pointer;
    padding: 0;
    border-radius: 50%;
    transition: background-color 0.2s;
    margin-left: 5px;
  }

  .chip-remove:hover {
    background: rgba(255, 255, 255, 0.5);
  }

  .btn-continuar {
    background: #007bff;
    color: white;
    border: none;
    padding: 10px 30px;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.2s;
  }

  .btn-continuar:hover {
    background: #0056b3;
  }

  .form-personal {
    max-width: 800px;
    margin: 30px auto;
    padding: 20px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }

  .total-info {
    background: #f8f9fa;
    padding: 10px 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    color: #333;
    font-size: 14px;
  }

  .form-section {
    margin-bottom: 30px;
  }

  .form-section-title {
    color: #00BCD4;
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .form-section-title i {
    color: #00BCD4;
    font-size: 24px;
  }

  .form-group-custom {
    margin-bottom: 20px;
  }

  .form-group-custom label {
    display: block;
    margin-bottom: 8px;
    color: #666;
    font-size: 14px;
  }

  .form-group-custom label.required::after {
    content: ' *';
    color: #dc3545;
  }

  .form-control-custom {
    width: 100%;
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    transition: border-color 0.2s;
  }

  .form-control-custom:focus {
    border-color: #00BCD4;
    outline: none;
    box-shadow: 0 0 0 2px rgba(0, 188, 212, 0.1);
  }

  /* Estilos específicos para la sección de pagos */
  .payment-section {
    text-align: center;
    max-width: 600px;
    margin: 0 auto;
    padding: 20px 0;
  }

  .payment-title {
    color: #00BCD4;
    font-size: 18px;
    text-align: center;
    margin-bottom: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
  }

  .payment-title i {
    color: #00BCD4;
    font-size: 20px;
  }

  .payment-subtitle {
    color: #999;
    font-size: 13px;
    text-align: center;
    margin-bottom: 20px;
  }

  .payment-methods {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(60px, 1fr));
    gap: 15px;
    margin: 20px auto;
    max-width: 500px;
  }

  .payment-method {
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    padding: 8px;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    background: white;
  }

  .payment-method img {
    max-width: 100%;
    height: auto;
    max-height: 25px;
    object-fit: contain;
  }

  .payment-method.active {
    border-color: #00BCD4;
    background: rgba(0, 188, 212, 0.05);
  }

  .payment-method.active::before {
    content: '✓';
    position: absolute;
    top: -8px;
    right: -8px;
    background: #00BCD4;
    color: white;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
  }

  .payment-info {
    text-align: center;
    margin: 15px 0;
  }

  .payment-info p {
    margin: 5px 0;
    color: #333;
  }

  .payment-info p.subtitle {
    color: #666;
    font-size: 13px;
  }

  .converter-container {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 12px;
    margin: 20px auto;
    max-width: 400px;
  }

  .converter-controls {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
    margin: 15px 0;
  }

  .converter-controls input {
    width: 40px;
    text-align: center;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 6px;
    background: white;
  }

  .btn-circle-custom {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    border: none;
    background: #333;
    color: white;
    font-size: 18px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .currency-options {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin: 15px 0;
  }

  .currency-option {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
  }

  .currency-option input[type="radio"] {
    accent-color: #00BCD4;
  }

  .conversion-result {
    background: #f1f1f1;
    border-radius: 8px;
    padding: 15px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin: 15px 0;
  }

  .amount {
    display: flex;
    justify-content: space-between;
    padding: 10px;
    background: #e9ecef;
    border-radius: 6px;
  }

  .amount span:first-child {
    color: #666;
  }

  .amount span:last-child {
    font-weight: bold;
    color: #333;
  }

  .exchange-rate {
    text-align: center;
    color: #666;
    font-size: 12px;
    margin-top: 10px;
  }

  .loading-text {
    position: sticky;
    bottom: 0;
    left: 0;
    right: 0;
    text-align: center;
    padding: 10px;
    background: rgba(255, 255, 255, 0.9);
    color: #666;
    font-size: 14px;
    display: none;
    z-index: 1000;
  }

  .loading-text.visible {
    display: block;
  }

  .seleccionados-container {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: white;
    padding: 20px;
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    z-index: 1000;
  }

  .seleccionados-text {
    font-size: 16px;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
  }

  .contador {
    font-size: 14px;
    color: #666;
    margin: 10px 0;
  }

  .boletos-seleccionados-chips {
    display: flex;
    gap: 10px;
    justify-content: center;
    flex-wrap: wrap;
    margin: 15px 0;
  }

  .boleto-chip {
    display: inline-flex;
    align-items: center;
    background: #007bff;
    color: white;
    padding: 8px 12px;
    border-radius: 20px;
    font-size: 14px;
    gap: 8px;
    cursor: default;
  }

  .chip-remove {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 20px;
    background: rgba(255, 255, 255, 0.3);
    border: none;
    color: white;
    font-size: 16px;
    cursor: pointer;
    padding: 0;
    border-radius: 50%;
    transition: background-color 0.2s;
    margin-left: 5px;
  }

  .chip-remove:hover {
    background: rgba(255, 255, 255, 0.5);
  }

  .btn-continuar {
    background: #007bff;
    color: white;
    border: none;
    padding: 10px 30px;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.2s;
  }

  .btn-continuar:hover {
    background: #0056b3;
  }

  .upload-section {
    border: 2px dashed #e0e0e0;
    border-radius: 8px;
    padding: 25px;
    text-align: center;
    margin: 20px 0;
    background: #f8f9fa;
  }

  .btn-upload {
    background: none;
    border: none;
    color: #00BCD4;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin: 0 auto;
    font-size: 14px;
  }

  .btn-confirmar {
    background: #00BCD4;
    color: white;
    border: none;
    padding: 15px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 16px;
    width: 100%;
    transition: background-color 0.2s;
    text-transform: uppercase;
    font-weight: 500;
    margin-top: 20px;
  }

  .btn-confirmar:hover {
    background: #008c9e;
  }
</style>

<div class="loading">Cargando boletos...</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const boletosSeleccionados = new Set();
    const minBoletos = 2;
    let cantidadSeleccion = 3;
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
      const total = cantidadSeleccion * precioUnitarioUSD;
      totalUSDSpan.textContent = `${total} USD`;
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

    // Función para alternar selección de boleto
    function toggleBoleto(elemento, numero) {
      if (elemento.classList.contains('selected')) {
        elemento.classList.remove('selected');
        boletosSeleccionados.delete(numero);
      } else {
        elemento.classList.add('selected');
        boletosSeleccionados.add(numero);
      }
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

    function actualizarContador() {
      const contador = document.querySelector('.contador');
      contador.textContent = `${boletosSeleccionados.size} de ${cantidadSeleccion}`;
    }

    function actualizarTotal() {
      const totalUSD = boletosSeleccionados.size * precioUnitarioUSD;
      const totalBS = totalUSD * tasaUSD;

      const usdAmount = document.getElementById('usdAmount');
      const bsAmount = document.getElementById('bsAmount');
      const totalUSDDisplay = document.getElementById('totalUSD');

      usdAmount.textContent = totalUSD.toFixed(2);
      bsAmount.textContent = totalBS.toFixed(2);
      totalUSDDisplay.textContent = totalUSD.toFixed(2) + ' USD';
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
  });
</script>