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