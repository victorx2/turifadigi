<!--Team One Start-->
<link rel="stylesheet" href="./assets/css/custom-styles.css">


<style>
  /* Estilos para la sección de datos personales */
  .personal-data-section {
    background-color: var(--light-bg);
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 30px;
  }

  .personal-data-section h4 {
    color: var(--text-color);
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid var(--border-color);
  }

  .personal-data-section h4 i {
    color: var(--primary-color);
    margin-right: 10px;
  }

  /* Mejoras en los campos del formulario */
  .form-group {
    margin-bottom: 20px;
  }

  .form-group label {
    display: block;
    font-weight: 500;
    margin-bottom: 8px;
    color: var(--text-color);
  }

  .form-group .form-control,
  .form-group .form-select {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid var(--border-color);
    border-radius: 8px;
    transition: all 0.3s ease;
    background-color: white;
  }

  .form-group .form-control:focus,
  .form-group .form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.15);
  }

  /* Mejoras en el grupo de teléfono */
  .phone-group {
    display: flex;
    gap: 10px;
  }

  .phone-group select {
    width: 120px;
    flex-shrink: 0;
  }

  .phone-group input {
    flex: 1;
  }

  /* Estilos para campos requeridos */
  .required-field::after {
    content: ' *';
    color: var(--error-color);
  }

  /* Estilos para la sección de métodos de pago */
  .payment-section {
    background-color: var(--light-bg);
    border-radius: 12px;
    padding: 25px;
    margin-top: 30px;
  }

  .payment-section h4 {
    color: var(--text-color);
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid var(--border-color);
  }

  .payment-section h4 i {
    color: var(--primary-color);
    margin-right: 10px;
  }

  /* Mejoras en el conversor */
  .calculatorContainer {
    background-color: white;
    border-radius: 12px;
    padding: 25px;
    margin-top: 30px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
  }

  .calculatorContainer h4 {
    margin-bottom: 20px;
    color: var(--text-color);
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .phone-group {
      flex-direction: column;
      gap: 15px;
    }

    .phone-group select {
      width: 100%;
    }
  }
</style>
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
        <div class="team-one__content">
          <h4 class="text-start"><i class="fa fa-user" aria-hidden="true"></i> DATOS PERSONALES</h4>
          <div class="row">
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label for="nombre" class="active">Nombres y Apellidos *</label>
                <input placeholder="Nombre Apellido" id="nombre" type="text" class="form-control validate" required>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label id="label_identification" for="identification" class="active">Cedula *</label>
                <input placeholder="9384235" id="identification" type="text" class="form-control validate" maxlength="12" minlength="6" required>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label class="active" for="celular">Celular *</label>
                <div class="input-group">
                  <select id="country_code" name="country_code" class="form-select" required>
                    <option value="+1">🇩🇴 +1</option>
                    <option value="+1">🇺🇸 +1</option>
                    <option value="+1">🇵🇷 +1</option>
                    <option value="+34">🇪🇸 +34</option>
                    <option value="+502">🇬🇹 +502</option>
                    <option value="+503">🇸🇻 +503</option>
                    <option value="+504">🇭🇳 +504</option>
                    <option value="+505">🇳🇮 +505</option>
                    <option value="+506">🇨🇷 +506</option>
                    <option value="+507">🇵🇦 +507</option>
                    <option value="+51">🇵🇪 +51</option>
                    <option value="+52">🇲🇽 +52</option>
                    <option value="+53">🇨🇺 +53</option>
                    <option value="+54">🇦🇷 +54</option>
                    <option value="+56">🇨🇱 +56</option>
                    <option value="+57">🇨🇴 +57</option>
                    <option value="+58" selected>🇻🇪 +58</option>
                    <option value="+591">🇧🇴 +591</option>
                    <option value="+593">🇪🇨 +593</option>
                    <option value="+595">🇵🇾 +595</option>
                    <option value="+598">🇺🇾 +598</option>
                  </select>
                  <input placeholder="4163829342" id="celular" type="tel" class="form-control validate" maxlength="14" minlength="8" required>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label id="label_location" for="location" class="active">Ubicación</label>
                <select id="location" name="location" class="form-select">
                  <option value="Amazonas">Amazonas</option>
                  <option value="Anzoategui">Anzoategui</option>
                  <option value="Apure">Apure</option>
                  <option value="Aragua">Aragua</option>
                  <option value="Barinas">Barinas</option>
                  <option value="Bolivar">Bolivar</option>
                  <option value="Carabobo">Carabobo</option>
                  <option value="Cojedes">Cojedes</option>
                  <option value="Delta Amacuro">Delta Amacuro</option>
                  <option value="Distrito Capital">Distrito Capital</option>
                  <option value="Falcon">Falcon</option>
                  <option value="Guarico">Guarico</option>
                  <option value="Lara">Lara</option>
                  <option value="Merida">Merida</option>
                  <option value="Miranda">Miranda</option>
                  <option value="Monagas">Monagas</option>
                  <option value="Nueva Esparta">Nueva Esparta</option>
                  <option value="Portuguesa">Portuguesa</option>
                  <option value="Sucre">Sucre</option>
                  <option value="Tachira" selected>Tachira</option>
                  <option value="Trujillo">Trujillo</option>
                  <option value="Vargas">Vargas</option>
                  <option value="Yaracuy">Yaracuy</option>
                  <option value="Zulia">Zulia</option>
                  <option value="Estados Unidos">Estados Unidos</option>
                  <option value="Otro Pais">Otro Pais</option>
                </select>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 extra_field_address" style="display:none">
              <div class="form-group">
                <label id="label_address" for="ubicacion" class="active">Dirección</label>
                <input placeholder="" id="ubicacion" type="text" class="form-control validate" maxlength="180" minlength="9">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 extra_field_custom" style="display:none">
            </div>
            <div class="col-lg-6 col-md-6 extra_field_seller" style="display:none">
            </div>
          </div>
        </div>

        <div id="sectionAllPayments" class="team-one__content mt-4">
          <h4 class="text-start"><i class="fa fa-bank" aria-hidden="true"></i> MODOS DE PAGO</h4>
          <div class="mb-3">
            <h6 class="text-start">Transferencia o depósito</h6>
          </div>
          <div id="container-payments" class="types mb-4">
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

          <div id="datosBanco" class="text-center mb-4">
            <div>
              <h6>
                <span data-toggle="tooltip" data-placement="bottom" title="PAGO MOVIL">PAGO MOVIL</span>
                <span data-toggle="tooltip" data-placement="bottom" title="Cuenta Personal">
                  <i class="help-account fa fa-user" aria-hidden="true"></i>
                </span>
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
            <span>Tasa de cambio: 1 USD = </span>
            <span class="changeRate">106.31</span>
            <span class="currencyCode">BS</span>
          </div>

          <div id="priceConvert" class="mt-3">
            <strong>Total: <span id="other">3401.92</span> <span class="currencyCode">BS</span>
              <small>(<span id="QtyNumberPrice">8</span> boletos)</small>
            </strong>
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