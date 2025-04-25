<!--Main Slider Start-->
<section class="main-slider">
  <!-- Contenedor principal del slider usando Swiper -->
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
    <!-- Contenedor de slides -->
    <div class="swiper-wrapper">

      <!-- Primer slide -->
      <div class="swiper-slide">
        <!-- Fondo y formas decorativas -->
        <div class="main-slider__bg" style="background-image: url(assets/img/backgrounds/sorteo.jpg);"></div>
        <div class="main-slider__shape-bg" style="background-image: url(assets/img/shapes/main-slider-shape-bg.png);"></div>
        <div class="main-slider__shape-1 float-bob-y">
          <img src="assets/img/shapes/main-slider-shape-1.png" alt="">
        </div>
        <div class="main-slider__shape-2 img-bounce">
          <img src="assets/img/shapes/main-slider-shape-2.png" alt="">
        </div>
        <!-- Contenido del slide -->
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

      <!-- Segundo slide -->
      <div class="swiper-slide">
        <!-- Fondo y formas decorativas -->
        <div class="main-slider__bg" style="background-image: url(assets/img/backgrounds/slider-1-2.jpg);"></div>
        <div class="main-slider__shape-bg" style="background-image: url(assets/img/shapes/main-slider-shature-bg.png);"></div>
        <div class="main-slider__shape-1 float-bob-y">
          <img src="assets/img/shapes/main-slider-shape-1.png" alt="">
        </div>
        <div class="main-slider__shape-2 img-bounce">
          <img src="assets/img/shapes/main-slider-shape-2.png" alt="">
        </div>
        <!-- Contenido del slide -->
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

      <!-- Tercer slide -->
      <div class="swiper-slide">
        <!-- Fondo y formas decorativas -->
        <div class="main-slider__bg" style="background-image: url(assets/img/backgrounds/slider-1-3.jpg);"></div>
        <div class="main-slider__shape-bg" style="background-image: url(assets/img/shapes/main-slider-shape-bg.png);"></div>
        <div class="main-slider__shape-1 float-bob-y">
          <img src="assets/img/shapes/main-slider-shape-1.png" alt="">
        </div>
        <div class="main-slider__shape-2 img-bounce">
          <img src="assets/img/shapes/main-slider-shape-2.png" alt="">
        </div>
        <!-- Contenido del slide -->
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

    <!-- Paginación del slider -->
    <div class="swiper-pagination" id="main-slider-pagination"></div>
  </div>
</section>
<!--Main Slider End-->






<?php require_once 'premio.php'; ?>





<!--Services One Start-->
<section class="services-one">
  <div class="container">
    <!-- Título y contador de boletos -->
    <div class="section-title text-center">
      <h2 class="section-title__title">LISTA DE BOLETOS</h2>
      <div class="progress-contain">
        <div class="progress-actual" style="width: 0%;"></div>
        <div class="progress-total"></div>
        <div class="progress-percent" id="progress-percent" style="left: 0%;">0%</div>
      </div>
      <div class="counter-section">
        <button class="thm-btn counter-btn minus">-</button>
        <div class="counter-display">
          <span id="currentCount">3</span>
          <span class="counter-label">BOLETOS</span>
        </div>
        <button class="thm-btn counter-btn plus">+</button>
      </div>
      <div class="total-amount">
        Total: <span id="totalAmount">12.00 USD</span>
      </div>
    </div>

    <!-- Barra de búsqueda -->
    <div class="search-box">
      <input type="text" id="searchInput" class="form-control" placeholder="BUSCAR">
      <button class="thm-btn search-btn">
        <i class="fas fa-search"></i> BUSCAR
      </button>
    </div>

    <!-- Sección para elegir boletos al azar -->
    <div class="elegir-suerte">
      ★ ELEGIR A LA SUERTE ★
    </div>

    <!-- Contenedor de la grilla de boletos -->
    <div class="boletos-container">
      <div class="boletos-grid" id="boletosGrid">
        <!-- Los boletos se generarán dinámicamente aquí -->
      </div>
    </div>

    <!-- Sección de boletos seleccionados -->
    <div class="selected-section">
      <div class="selected-header">
        SELECCIONADOS
        <span id="selectedCounter">0 de 3</span>
      </div>
      <div class="selected-numbers" id="selectedNumbers">
        <!-- Los números seleccionados aparecerán aquí -->
      </div>
      <button class="thm-btn continue-btn" id="continueBtn" disabled>
        CONTINUAR
      </button>
    </div>
  </div>
</section>

<!--Services One End-->

<!-- Verificador de Boletos Start -->
<section class="services-one">
  <div class="container">
    <div class="section-title text-center">
      <h2 class="section-title__title">VERIFICADOR DE BOLETOS</h2>
    </div>

    <div class="verificador-container">
      <div class="search-box">
        <input type="text" id="findTicket" class="form-control" placeholder="Cédula o #Boleto" maxlength="16">
        <button class="thm-btn search-btn" id="searchTicket">
          <i class="fas fa-search"></i> BUSCAR
        </button>
      </div>

      <div id="resultTickets" class="result-container" style="display: none;">
        <div class="result-header">
          <h5>
            <strong id="msjNombre"></strong>
          </h5>
          <div class="qr-container">
            <img id="qrCode" class="qr" src="" alt="QR" width="120" height="120">
          </div>
          <p id="msjRptaBusqueda"></p>
          <div class="view-toggle">
            <label class="switch">
              <input type="checkbox" onchange="changeViewTicket(event)">
              <span class="lever"></span> Sólo números
            </label>
          </div>
        </div>

        <div id="misticketsdiv" class="tickets-container">
          <div id="numbersContain" style="display:none"></div>
          <div id="ticketsContain">
            <div class="container_ticket">
              <widget id="widgetTicket" type="ticket" class="--flex-column"></widget>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
  /* Estilos base */
  .counter-section {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    margin: 1rem 0;
  }

  .counter-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .counter-display {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .counter-display #currentCount {
    font-size: 2rem;
    font-weight: bold;
    color: var(--thm-base);
  }

  .counter-label {
    font-size: 0.9rem;
    color: var(--thm-gray);
  }

  .total-amount {
    font-size: 1.2rem;
    font-weight: 500;
    color: var(--thm-black);
    margin: 1rem 0;
  }

  .search-box {
    display: flex;
    gap: 1rem;
    max-width: 600px;
    margin: 2rem auto;
  }

  .search-box input {
    flex: 1;
    padding: 0.8rem 1.5rem;
    border: 1px solid var(--thm-border-color);
    border-radius: 25px;
    font-size: 1rem;
  }

  .elegir-suerte {
    text-align: center;
    font-size: 1.2rem;
    color: var(--thm-base);
    margin: 2rem 0;
    padding: 1rem;
    background-color: rgba(var(--thm-base-rgb), 0.1);
    border-radius: 10px;
  }

  .boletos-container {
    max-height: 500px;
    overflow-y: auto;
    padding: 1rem;
    margin: 2rem 0;
  }

  .boletos-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(70px, 1fr));
    gap: 0.5rem;
  }

  .boleto {
    background-color: var(--thm-white);
    border: 1px solid var(--thm-border-color);
    padding: 0.8rem;
    text-align: center;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.9rem;
  }

  .boleto:hover {
    background-color: rgba(var(--thm-base-rgb), 0.1);
  }

  .boleto.selected {
    background-color: var(--thm-black);
    color: var(--thm-white);
    border-color: var(--thm-black);
  }

  .selected-section {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: var(--thm-white);
    padding: 1rem;
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
  }

  .selected-header {
    font-size: 1.1rem;
    color: var(--thm-black);
    margin-bottom: 1rem;
  }

  .selected-numbers {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
    flex-wrap: wrap;
    margin: 1rem 0;
  }

  .selected-number {
    background-color: var(--thm-black);
    color: var(--thm-white);
    padding: 0.5rem 1rem;
    border-radius: 5px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }

  .selected-number button {
    background: none;
    border: none;
    color: var(--thm-white);
    cursor: pointer;
    font-size: 1.2rem;
    padding: 0;
  }

  .continue-btn {
    width: 100%;
    max-width: 300px;
  }

  .continue-btn:disabled {
    background-color: var(--thm-gray);
    cursor: not-allowed;
  }

  /* Responsive */
  @media (max-width: 991px) {
    .boletos-grid {
      grid-template-columns: repeat(auto-fill, minmax(60px, 1fr));
    }

    .search-box {
      flex-direction: column;
    }

    .counter-section {
      flex-direction: column;
    }
  }

  @media (max-width: 767px) {
    .boletos-grid {
      grid-template-columns: repeat(auto-fill, minmax(50px, 1fr));
    }

    .selected-section {
      position: relative;
      margin-top: 2rem;
    }
  }

  /* Estilos para la sección de pagos */
  .types {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    justify-content: space-between;
  }

  .type {
    width: 100px;
    height: 100px;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .type:hover {
    border-color: #00BCD4;
    box-shadow: 0 0 10px rgba(0, 188, 212, 0.2);
  }

  .type.selected {
    border-color: #00BCD4;
    background-color: rgba(0, 188, 212, 0.1);
  }

  .type .logo {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .type .logo img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
  }

  .calculatorContainer {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    margin: 20px 0;
  }

  .calculatorCon {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin: 1rem 0;
  }

  .btnMinus,
  .btnPlus {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: none;
    background-color: #00BCD4;
    color: white;
    font-size: 1.5rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .ticketQty {
    width: 60px;
    text-align: center;
    padding: 0.5rem;
    border: 1px solid #ddd;
    border-radius: 5px;
  }

  .calculatorRadio {
    display: flex;
    gap: 1rem;
    margin: 1rem 0;
  }

  .calculatorCurrencies {
    display: flex;
    justify-content: space-between;
    margin: 1rem 0;
  }

  .cal-group {
    text-align: center;
  }

  .cal-group p {
    margin: 0;
    color: #666;
  }

  .cal-group strong {
    font-size: 1.2rem;
    color: #333;
  }

  #priceConvert {
    text-align: center;
    font-size: 1.2rem;
    margin: 1rem 0;
  }

  #bottomcontact {
    text-align: center;
    color: #666;
    margin: 1rem 0;
  }

  .hidden {
    display: none;
  }

  .verificador-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem;
    background: var(--thm-white);
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
  }

  .search-box {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
  }

  .search-box input {
    flex: 1;
    padding: 0.8rem 1.5rem;
    border: 1px solid var(--thm-border-color);
    border-radius: 25px;
    font-size: 1rem;
  }

  .result-container {
    margin-top: 2rem;
  }

  .result-header {
    text-align: center;
    margin-bottom: 2rem;
  }

  .qr-container {
    margin: 1rem 0;
  }

  .qr {
    border: 1px solid var(--thm-border-color);
    padding: 0.5rem;
    border-radius: 10px;
  }

  .view-toggle {
    margin: 1rem 0;
  }

  .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
  }

  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .lever {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 34px;
  }

  .lever:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
  }

  input:checked+.lever {
    background-color: var(--thm-base);
  }

  input:checked+.lever:before {
    transform: translateX(26px);
  }

  .tickets-container {
    margin-top: 2rem;
  }

  .container_ticket {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    justify-content: center;
  }

  /* Estilos para la barra de progreso */
  .progress-contain {
    position: relative;
    width: 100%;
    max-width: 600px;
    height: 20px;
    background-color: #f0f0f0;
    border-radius: 10px;
    margin: 20px auto;
    overflow: hidden;
  }

  .progress-actual {
    position: absolute;
    height: 100%;
    background-color: var(--thm-base);
    transition: width 0.3s ease;
  }

  .progress-total {
    position: absolute;
    width: 100%;
    height: 100%;
    background-color: transparent;
  }

  .progress-percent {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    color: var(--thm-black);
    font-size: 12px;
    font-weight: bold;
    transition: left 0.3s ease;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const elements = {
      boletosGrid: document.getElementById('boletosGrid'),
      searchInput: document.getElementById('searchInput'),
      selectedNumbers: document.getElementById('selectedNumbers'),
      selectedCounter: document.getElementById('selectedCounter'),
      continueBtn: document.getElementById('continueBtn'),
      currentCount: document.getElementById('currentCount'),
      totalAmount: document.getElementById('totalAmount'),
      minusBtn: document.querySelector('.counter-btn.minus'),
      plusBtn: document.querySelector('.counter-btn.plus')
    };

    const state = {
      totalBoletos: 10000,
      selectedBoletos: new Set(),
      maxSelection: 3,
      pricePerBoleto: 4,
      lastLoadedBoleto: 0,
      batchSize: 100,
      isLoading: false,
      progressSteps: {
        boletos: 0,
        nombre: false,
        identificacion: false,
        celular: false,
        ubicacion: false
      }
    };

    function updateProgress() {
      const totalSteps = 5; // Total de pasos a completar
      let completedSteps = 0;

      // Verificar boletos seleccionados (30% del progreso)
      const boletosProgress = (state.selectedBoletos.size / state.maxSelection) * 30;
      completedSteps += boletosProgress;

      // Verificar datos personales (70% del progreso)
      if (state.progressSteps.nombre) completedSteps += 20;
      if (state.progressSteps.identificacion) completedSteps += 20;
      if (state.progressSteps.celular) completedSteps += 15;
      if (state.progressSteps.ubicacion) completedSteps += 15;

      const progress = Math.min(completedSteps, 100);
      const progressActual = document.querySelector('.progress-actual');
      const progressPercent = document.getElementById('progress-percent');

      progressActual.style.width = `${progress}%`;
      progressPercent.style.left = `${progress}%`;
      progressPercent.textContent = `${progress.toFixed(1)}%`;
    }

    function updateUI() {
      // Actualizar contador
      elements.selectedCounter.textContent = `${state.selectedBoletos.size} de ${state.maxSelection}`;

      // Actualizar total
      const total = state.selectedBoletos.size * state.pricePerBoleto;
      elements.totalAmount.textContent = `${total.toFixed(2)} USD`;

      // Actualizar botón continuar
      elements.continueBtn.disabled = state.selectedBoletos.size < state.maxSelection;

      // Actualizar números seleccionados
      renderSelectedNumbers();

      // Actualizar barra de progreso
      updateProgress();
    }

    function renderSelectedNumbers() {
      elements.selectedNumbers.innerHTML = '';
      Array.from(state.selectedBoletos).sort().forEach(numero => {
        const div = document.createElement('div');
        div.className = 'selected-number';
        div.innerHTML = `
                    ${numero}
                    <button onclick="removeNumber('${numero}')">&times;</button>
                `;
        elements.selectedNumbers.appendChild(div);
      });
    }

    function loadMoreBoletos() {
      if (state.isLoading || state.lastLoadedBoleto >= state.totalBoletos) return;

      state.isLoading = true;
      const fragment = document.createDocumentFragment();
      const start = state.lastLoadedBoleto + 1;
      const end = Math.min(start + state.batchSize - 1, state.totalBoletos);

      for (let i = start; i <= end; i++) {
        const numero = i.toString().padStart(4, '0');
        const boleto = document.createElement('div');
        boleto.className = 'boleto';
        if (state.selectedBoletos.has(numero)) {
          boleto.classList.add('selected');
        }
        boleto.textContent = numero;
        boleto.onclick = () => toggleBoleto(numero, boleto);
        fragment.appendChild(boleto);
      }

      elements.boletosGrid.appendChild(fragment);
      state.lastLoadedBoleto = end;
      state.isLoading = false;
    }

    function toggleBoleto(numero, element) {
      if (state.selectedBoletos.has(numero)) {
        state.selectedBoletos.delete(numero);
        element.classList.remove('selected');
      } else if (state.selectedBoletos.size < state.maxSelection) {
        state.selectedBoletos.add(numero);
        element.classList.add('selected');
      }
      updateUI();
    }

    // Exponer función para eliminar números (necesaria para el onclick en el HTML)
    window.removeNumber = function(numero) {
      state.selectedBoletos.delete(numero);
      const boleto = elements.boletosGrid.querySelector(`.boleto[data-numero="${numero}"]`);
      if (boleto) {
        boleto.classList.remove('selected');
      }
      updateUI();
    };

    // Función para verificar datos personales
    function verificarDatosPersonales() {
      const nombre = document.getElementById('nombre').value;
      const identification = document.getElementById('identification').value;
      const celular = document.getElementById('celular').value;
      const ubicacion = document.getElementById('location').value;

      state.progressSteps.nombre = nombre.length > 0;
      state.progressSteps.identificacion = identification.length > 0;
      state.progressSteps.celular = celular.length > 0;
      state.progressSteps.ubicacion = ubicacion !== 'Tachira'; // Asumiendo que Tachira es el valor por defecto

      updateProgress();
    }

    // Agregar event listeners para los campos de datos personales
    document.getElementById('nombre').addEventListener('input', verificarDatosPersonales);
    document.getElementById('identification').addEventListener('input', verificarDatosPersonales);
    document.getElementById('celular').addEventListener('input', verificarDatosPersonales);
    document.getElementById('location').addEventListener('change', verificarDatosPersonales);

    // Event Listeners
    elements.minusBtn.onclick = () => {
      if (state.maxSelection > 1) {
        state.maxSelection--;
        elements.currentCount.textContent = state.maxSelection;
        updateUI();
      }
    };

    elements.plusBtn.onclick = () => {
      if (state.maxSelection < 10) {
        state.maxSelection++;
        elements.currentCount.textContent = state.maxSelection;
        updateUI();
      }
    };

    elements.searchInput.addEventListener('input', (e) => {
      const searchValue = e.target.value.trim();
      if (searchValue) {
        const numero = parseInt(searchValue);
        if (!isNaN(numero) && numero > 0 && numero <= state.totalBoletos) {
          elements.boletosGrid.innerHTML = '';
          const boleto = document.createElement('div');
          boleto.className = 'boleto';
          const numeroStr = numero.toString().padStart(4, '0');
          if (state.selectedBoletos.has(numeroStr)) {
            boleto.classList.add('selected');
          }
          boleto.textContent = numeroStr;
          boleto.onclick = () => toggleBoleto(numeroStr, boleto);
          elements.boletosGrid.appendChild(boleto);
        }
      } else {
        elements.boletosGrid.innerHTML = '';
        state.lastLoadedBoleto = 0;
        loadMoreBoletos();
      }
    });

    // Scroll infinito
    const boletosContainer = document.querySelector('.boletos-container');
    boletosContainer.addEventListener('scroll', () => {
      if (boletosContainer.scrollHeight - boletosContainer.scrollTop <= boletosContainer.clientHeight + 100) {
        loadMoreBoletos();
      }
    });

    // Inicialización
    loadMoreBoletos();
    updateUI();
  });

  // Funcionalidad para la sección de pagos
  document.addEventListener('DOMContentLoaded', function() {
    // Elementos del DOM
    const btnMinusCal = document.getElementById('btnMinusCal');
    const btnPlusCal = document.getElementById('btnPlusCal');
    const ticketQty = document.getElementById('ticketQtyID');
    const montoTotalCal = document.getElementById('montoTotalCal');
    const montoTotalCalFormatt = document.getElementById('montoTotalCalFormatt');
    const other = document.getElementById('other');
    const QtyNumberPrice = document.getElementById('QtyNumberPrice');
    const currencyRadios = document.querySelectorAll('input[name="currency"]');
    const currencyCode = document.querySelectorAll('.currencyCode');
    const changeRate = document.querySelector('.changeRate');

    // Variables
    let currentQty = 3;
    let currentCurrency = 'BS';
    let currentRate = 106.31;
    const pricePerTicket = 4;

    // Funciones
    function updateCalculations() {
      const totalUSD = currentQty * pricePerTicket;
      const totalLocal = totalUSD * currentRate;

      montoTotalCal.textContent = totalUSD.toFixed(2);
      montoTotalCalFormatt.textContent = totalLocal.toFixed(2);
      other.textContent = totalLocal.toFixed(2);
      QtyNumberPrice.textContent = currentQty;
    }

    function updateCurrency(currency) {
      currentCurrency = currency;
      currencyCode.forEach(el => el.textContent = currency);

      // Aquí podrías hacer una llamada a una API para obtener la tasa de cambio actual
      switch (currency) {
        case 'BS':
          currentRate = 106.31;
          break;
        case 'COP':
          currentRate = 4000;
          break;
        case 'CLP':
          currentRate = 900;
          break;
      }

      changeRate.textContent = currentRate.toFixed(2);
      updateCalculations();
    }

    // Event Listeners
    btnMinusCal.addEventListener('click', () => {
      if (currentQty > 3) {
        currentQty--;
        ticketQty.value = currentQty;
        updateCalculations();
      }
    });

    btnPlusCal.addEventListener('click', () => {
      if (currentQty < 1000) {
        currentQty++;
        ticketQty.value = currentQty;
        updateCalculations();
      }
    });

    ticketQty.addEventListener('change', (e) => {
      const value = parseInt(e.target.value);
      if (value >= 3 && value <= 1000) {
        currentQty = value;
        updateCalculations();
      } else {
        e.target.value = currentQty;
      }
    });

    currencyRadios.forEach(radio => {
      radio.addEventListener('change', (e) => {
        updateCurrency(e.target.value);
      });
    });

    // Inicialización
    updateCalculations();
  });

  // Función para mostrar detalles de pago
  function showPaymentDetails(paymentId) {
    const paymentOptions = document.querySelectorAll('.option-payment');
    paymentOptions.forEach(option => {
      option.classList.remove('selected');
    });

    const selectedOption = document.getElementById(paymentId);
    selectedOption.classList.add('selected');

    // Aquí podrías agregar la lógica para mostrar los detalles específicos del método de pago seleccionado
    const datosBanco = document.getElementById('datosBanco');
    const paymentTitle = datosBanco.querySelector('h6 span:first-child');

    switch (paymentId) {
      case '2':
        paymentTitle.textContent = 'PAGO MOVIL';
        break;
      case '3':
        paymentTitle.textContent = 'ZELLE';
        break;
      case '4':
        paymentTitle.textContent = 'ZINLI';
        break;
        // Agregar más casos según sea necesario
    }
  }

  document.addEventListener('DOMContentLoaded', function() {
    const searchTicket = document.getElementById('searchTicket');
    const findTicket = document.getElementById('findTicket');
    const resultTickets = document.getElementById('resultTickets');

    searchTicket.addEventListener('click', function() {
      const searchValue = findTicket.value.trim();
      if (searchValue) {
        // Aquí iría tu lógica de búsqueda
        resultTickets.style.display = 'block';
      }
    });

    findTicket.addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
        searchTicket.click();
      }
    });
  });

  function changeViewTicket(event) {
    const numbersContain = document.getElementById('numbersContain');
    const ticketsContain = document.getElementById('ticketsContain');

    if (event.target.checked) {
      numbersContain.style.display = 'block';
      ticketsContain.style.display = 'none';
    } else {
      numbersContain.style.display = 'none';
      ticketsContain.style.display = 'block';
    }
  }
</script>

<?php require_once 'views/sorteo/whatsapp.php'; ?>
<?php require_once 'views/sorteo/personal.php'; ?>
<?php /* require_once 'views/sorteo/datos_personales_original.php'; */ ?>