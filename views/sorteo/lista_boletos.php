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

<!--Services One Start-->
<section class="services-one">
  <div class="container">
    <!-- Título y contador de boletos -->
    <div class="section-title text-center">
      <h2 class="section-title__title">LISTA DE BOLETOS</h2>
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

<!-- Estilos CSS para la sección -->
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
      isLoading: false
    };

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
</script>

<!--Team One Start-->
<section class="team-one">
  <div class="team-one__bg-box">
    <div class="team-one__bg">
    </div>
  </div>
  <div class="container">
    <div class="section-title text-center">
      <div class="section-title__tagline-box">
        <div class="section-title__tagline-shape">
        </div>
      </div>
      <h2 class="section-title__title"></h2>
    </div>
    <div class="row">
      <div class="col-xl-12">
        <h4 class="text-start"><i class="fa fa-user" aria-hidden="true"></i> DATOS PERSONALES</h4>
        <div id="sectionAllPayments">
          <h4 class="mt-20 text-start"><i class="fa fa-bank" aria-hidden="true"></i> MODOS DE PAGO</h4>
          <div class="col-lg-12 mb-10">
            <div class="row">
              <div class="input-field col s6 m6">
                <h6 class="text-start">Transferencia o depósito</h6>
              </div>
            </div>
          </div>
          <div id="container-payments" class="types flex flex-wrap justify-space-between payments-options mb-30">
            <div id="2" class="type option-payment selected" onclick="showPaymentDetails(2)">
              <div class="logo">
                <img src="./assets/imgs/26436fd4e0.png" width="86" alt="PAGOMOVIL">
              </div>
            </div>
            <div id="3" class="type option-payment" onclick="showPaymentDetails(3)">
              <div class="logo">
                <img src="./assets/imgs/f855e644c1.png" width="86" alt="ZELLE">
              </div>
            </div>
            <div id="4" class="type option-payment" onclick="showPaymentDetails(4)">
              <div class="logo">
                <img src="./assets/imgs/9fbaef2914.png" width="86" alt="ZINLI">
              </div>
            </div>
            <div id="8" class="type option-payment" onclick="showPaymentDetails(8)">
              <div class="logo">
                <img src="./assets/imgs/cbe783cd0c.png" width="86" alt="BANCOLOMBIA-COLOMBIA">
              </div>
            </div>
            <div id="10" class="type option-payment" onclick="showPaymentDetails(10)">
              <div class="logo">
                <img src="./assets/imgs/3cdacb6a28.webp" width="86" alt="PAYPAL">
              </div>
            </div>
            <div id="11" class="type option-payment" onclick="showPaymentDetails(11)">
              <div class="logo">
                <img src="./assets/imgs/286d7c71c4.webp" width="86" alt="BANCOESTADO">
              </div>
            </div>
            <div id="12" class="type option-payment" onclick="showPaymentDetails(12)">
              <div class="logo">
                <img src="./assets/imgs/d61cb60139.png" width="86" alt="NEQUI">
              </div>
            </div>
            <div id="6" class="type option-payment" onclick="showPaymentDetails(6)">
              <div class="logo">
                <img src="./assets/imgs/5ca96231f2.png" width="86" alt="TENPO-CHILE">
              </div>
            </div>
            <div id="7" class="type option-payment" onclick="showPaymentDetails(7)">
              <div class="logo">
                <img src="./assets/imgs/e01157f052.png" width="86" alt="EFECTIVO">
              </div>
            </div>
            <div id="9" class="type option-payment" onclick="showPaymentDetails(9)">
              <div class="logo">
                <img src="./assets/imgs/e9ed10e44a.png" width="86" alt="BINANCE">
              </div>
            </div>
          </div>

          <div id="datosBanco" class="text-center input-field col s12 m6">
            <div>
              <h6>
                <span data-toggle="tooltip" data-placement="bottom" title="PAGO MOVIL">PAGO MOVIL</span>
                <span data-toggle="tooltip" data-placement="bottom" title="Cuenta Personal"><i class="help-account fa fa-user" aria-hidden="true"></i></span>
              </h6>
            </div>
            <div class="titularBank">Cuenta a Consultar</div>
            <div class="payment-notes"><b></b></div>
          </div>

          <div class="calculatorContainer">
            <h4>Conversor USD a <strong class="currencyCode">BS</strong></h4>
            <div class="calculatorCon">
              <button id="btnMinusCal" class="btnMinus"></button>
              <div>
                <input class="ticketQty" id="ticketQtyID" type="text" name="productQty" value="3" min="3" max="1000">
              </div>
              <button id="btnPlusCal" class="btnPlus"></button>
            </div>
            <div class="calculatorRadio">
              <div>
                <label for="BS">BS</label>
                <input type="radio" name="currency" id="BS" value="BS" checked>
              </div>
              <div>
                <label for="COP">COP</label>
                <input type="radio" name="currency" id="COP" value="COP">
              </div>
              <div>
                <label for="CLP">CLP</label>
                <input type="radio" name="currency" id="CLP" value="CLP">
              </div>
            </div>
            <div class="calculatorCurrencies">
              <div class="cal-group">
                <p>USD</p>
                <strong id="montoTotalCal">32.00</strong>
              </div>
              <div class="cal-group">
                <p class="currencyCode">BS</p>
                <strong id="montoTotalCalFormatt">3401.92</strong>
              </div>
            </div>
            <span>Tasa de cambio: 1 USD = </span> <span class="changeRate">106.31</span> <span class="currencyCode">BS</span>
          </div>

          <div id="priceConvert" class="">
            <strong>Total: <span id="other">3401.92</span> <span class="currencyCode">BS</span> <small> (<span id="QtyNumberPrice">8</span> boletos)</small></strong>
          </div>
          <div id="bottomcontact" class="hidden">
            <strong>CONSULTAR LA TASA DEL DIA</strong>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--Team One End-->