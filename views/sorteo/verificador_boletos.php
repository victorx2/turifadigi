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