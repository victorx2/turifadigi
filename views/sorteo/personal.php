<!--Team One Start-->
<link rel="stylesheet" href="./assets/css/custom-styles.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
  .black-section {
    background-color: #1a1a1a;
    padding: 30px 0;
    margin-bottom: 30px;
  }

  .lottery-cards {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(60px, 1fr));
    gap: 10px;
    padding: 20px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    margin-bottom: 30px;
  }

  .lottery-card {
    background: white;
    border-radius: 8px;
    padding: 10px;
    text-align: center;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .lottery-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }

  .personal-data-section {
    background-color: #fff;
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 30px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
  }

  .section-header {
    color: #333;
    font-size: 1.2rem;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid #eee;
    display: flex;
    align-items: center;
  }

  .section-header i {
    color: #00a6e7;
    margin-right: 10px;
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-group label {
    display: block;
    font-weight: 500;
    margin-bottom: 8px;
    color: #555;
  }

  .form-control {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    transition: all 0.3s ease;
    background-color: white;
  }

  .form-control:focus {
    border-color: #00a6e7;
    box-shadow: 0 0 0 0.2rem rgba(0, 166, 231, 0.15);
  }

  .required::after {
    content: ' *';
    color: #dc3545;
  }

  .phone-group {
    display: flex;
    gap: 10px;
    align-items: flex-start;
  }

  .phone-group select {
    width: 140px;
    flex-shrink: 0;
  }

  .phone-group input {
    flex: 1;
  }

  /* Estilos para métodos de pago */
  .payment-methods {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(86px, 1fr));
    gap: 15px;
    margin: 20px 0;
  }

  .payment-method {
    background: #fff;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    padding: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
  }

  .payment-method.selected {
    border-color: #00a6e7;
    background-color: #f8f9ff;
  }

  .payment-method img {
    width: 86px;
    height: auto;
  }

  /* Estilos para el conversor */
  .calculator {
    background-color: #fff;
    border-radius: 12px;
    padding: 25px;
    margin: 20px auto;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    max-width: 500px;
  }

  .calculator-controls {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin: 15px 0;
  }

  .calculator-input {
    width: 80px;
    text-align: center;
    padding: 8px;
    border: 2px solid #e0e0e0;
    border-radius: 6px;
  }

  .calculator-btn {
    width: 32px;
    height: 32px;
    border: none;
    border-radius: 6px;
    background: #00a6e7;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .currency-options {
    display: flex;
    gap: 15px;
    justify-content: center;
    margin: 15px 0;
  }

  .currency-option {
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .conversion-result {
    background: #f8f9ff;
    padding: 15px;
    border-radius: 8px;
    margin-top: 15px;
    text-align: center;
  }

  .conversion-result .amount {
    font-size: 1.2rem;
    font-weight: bold;
    color: #333;
  }

  @media (max-width: 768px) {
    .payment-methods {
      grid-template-columns: repeat(auto-fit, minmax(70px, 1fr));
    }

    .phone-group {
      flex-direction: column;
    }

    .phone-group select,
    .phone-group input {
      width: 100%;
    }
  }
</style>

<div class="black-section">
  <div class="container">
    <div class="lottery-cards">
      <div class="lottery-card">0129</div>
      <div class="lottery-card">0130</div>
      <div class="lottery-card">0131</div>
      <!-- Agrega más cartas según necesites -->
    </div>
  </div>
</div>

<div class="container">
  <div class="personal-data-section">
    <h4 class="section-header">
      <i class="fas fa-user"></i>
      DATOS PERSONALES
    </h4>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="nombre" class="required">Nombres y Apellidos</label>
          <input type="text" id="nombre" class="form-control" placeholder="Nombre Apellido" required>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="cedula" class="required">Cédula</label>
          <input type="text" id="cedula" class="form-control" placeholder="9384235" required>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="celular" class="required">Celular</label>
          <div class="phone-group">
            <select id="country_code" class="form-control">
              <option value="+58" selected>🇻🇪 +58</option>
              <!-- otros países -->
            </select>
            <input type="tel" id="celular" class="form-control" placeholder="4163829342" required>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="ubicacion" class="required">Ubicación</label>
          <select id="ubicacion" class="form-control" required>
            <option value="">Seleccione ubicación</option>
            <option value="Tachira" selected>Táchira</option>
            <!-- otros estados -->
          </select>
        </div>
      </div>
    </div>
  </div>

  <div class="calculator">
    <h4 class="text-center">Conversor USD a <span class="currency">BS</span></h4>

    <div class="calculator-controls">
      <button class="calculator-btn">-</button>
      <input type="text" class="calculator-input" value="3" min="3" max="1000">
      <button class="calculator-btn">+</button>
    </div>

    <div class="currency-options">
      <div class="currency-option">
        <input type="radio" name="currency" id="bs" checked>
        <label for="bs">BS</label>
      </div>
      <div class="currency-option">
        <input type="radio" name="currency" id="cop">
        <label for="cop">COP</label>
      </div>
      <div class="currency-option">
        <input type="radio" name="currency" id="clp">
        <label for="clp">CLP</label>
      </div>
    </div>

    <div class="conversion-result">
      <div class="row">
        <div class="col-6">
          <p>USD</p>
          <span class="amount">12.00</span>
        </div>
        <div class="col-6">
          <p>BS</p>
          <span class="amount">1275.72</span>
        </div>
      </div>
      <div class="mt-2">
        <small>Tasa de cambio: 1 USD = 106.31 BS</small>
      </div>
    </div>
  </div>

  <div class="personal-data-section">
    <h4 class="section-header">
      <i class="fas fa-money-bill"></i>
      MODOS DE PAGO
    </h4>
    <p>Transferencia o depósito</p>

    <div class="payment-methods">
      <div class="payment-method selected">
        <img src="./assets/imgs/26436fd4e0.png" alt="PAGO MOVIL">
      </div>
      <div class="payment-method">
        <img src="./assets/imgs/f855e644c1.png" alt="ZELLE">
      </div>
      <div class="payment-method">
        <img src="./assets/imgs/9fbaef2914.png" alt="ZINLI">
      </div>
    </div>

    <div class="mt-4">
      <div class="form-group">
        <label for="titular" class="required">Titular</label>
        <input type="text" id="titular" class="form-control" placeholder="Nombre del Titular" required>
      </div>

      <div class="form-group">
        <label for="referencia" class="required">Referencia de pago (últimos 4 dígitos)</label>
        <input type="text" id="referencia" class="form-control" placeholder="Número de Referencia" required>
      </div>

      <div class="form-group">
        <label for="metodo_pago" class="required">Método de pago</label>
        <select id="metodo_pago" class="form-control" required>
          <option value="">Seleccione un método</option>
          <option value="banco_venezuela">Banco de Venezuela</option>
        </select>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Inicializar los métodos de pago
    const paymentMethods = document.querySelectorAll('.payment-method');
    paymentMethods.forEach(method => {
      method.addEventListener('click', function() {
        paymentMethods.forEach(m => m.classList.remove('selected'));
        this.classList.add('selected');
      });
    });

    // Inicializar los controles del calculador
    const minusBtn = document.querySelector('.calculator-btn:first-child');
    const plusBtn = document.querySelector('.calculator-btn:last-child');
    const input = document.querySelector('.calculator-input');

    minusBtn.addEventListener('click', () => {
      const currentValue = parseInt(input.value);
      if (currentValue > parseInt(input.min)) {
        input.value = currentValue - 1;
      }
    });

    plusBtn.addEventListener('click', () => {
      const currentValue = parseInt(input.value);
      if (currentValue < parseInt(input.max)) {
        input.value = currentValue + 1;
      }
    });
  });
</script>