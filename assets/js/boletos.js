/**
 * ==============================================
 * CÓDIGO PRINCIPAL PARA LA SELECCIÓN DE BOLETOS
 * ==============================================
 *
 * Este código maneja la lógica completa para:
 * 1. Mostrar y seleccionar boletos
 * 2. Gestionar el estado de los boletos (disponibles, reservados, vendidos)
 * 3. Calcular montos y progreso de compra
 * 4. Manejar la interfaz de usuario relacionada
 */

/**
 * Clase principal para manejar la lógica de boletos
 */
class BoletosManager {
  constructor() {
    this.initializeState();
    this.initializeElements();
    this.initializeEventListeners();
    this.initializeApp();
  }

  /**
   * Inicializa el estado de la aplicación
   */
  initializeState() {
    this.state = {
      totalBoletos: 10000,
      selectedBoletos: new Set(),
      maxSelection: 2,
      pricePerBoleto: 3,
      lastLoadedBoleto: 0,
      batchSize: 1000,
      isLoading: false,
      currency: {
        current: "BS",
        rates: {
          BS: 106.31,
          COP: 4000,
          CLP: 900,
        },
      },
      progress: {
        boletos: 0,
        nombre: false,
        identificacion: false,
        celular: false,
        ubicacion: false,
      },
    };
  }

  /**
   * Inicializa los elementos del DOM
   */
  initializeElements() {
    this.elements = {
      boletosGrid: document.getElementById("boletosGrid"),
      searchInput: document.getElementById("searchInput"),
      selectedNumbers: document.getElementById("selectedNumbers"),
      selectedCounter: document.getElementById("selectedCounter"),
      continueBtn: document.getElementById("continueBtn"),
      currentCount: document.getElementById("currentCount"),
      totalAmount: document.getElementById("totalAmount"),
      minusBtn: document.querySelector(".counter-btn.minus"),
      plusBtn: document.querySelector(".counter-btn.plus"),
      form: document.getElementById("compraForm"),
      calculator: {
        minus: document.getElementById("btnMinusCal"),
        plus: document.getElementById("btnPlusCal"),
        quantity: document.getElementById("ticketQtyID"),
        totalUSD: document.getElementById("montoTotalCal"),
        totalLocal: document.getElementById("montoTotalCalFormatt"),
        otherAmount: document.getElementById("other"),
        quantityDisplay: document.getElementById("QtyNumberPrice"),
        currencyRadios: document.querySelectorAll('input[name="currency"]'),
        currencyLabels: document.querySelectorAll(".currencyCode"),
        rateDisplay: document.querySelector(".changeRate"),
      },
      personalData: {
        nombre: document.getElementById("nombre"),
        identification: document.getElementById("identification"),
        celular: document.getElementById("celular"),
        ubicacion: document.getElementById("location"),
      },
    };
  }

  /**
   * Inicializa los event listeners
   */
  initializeEventListeners() {
    // Event listeners para selección de boletos
    this.elements.minusBtn?.addEventListener("click", () =>
      this.updateMaxSelection("decrease")
    );
    this.elements.plusBtn?.addEventListener("click", () =>
      this.updateMaxSelection("increase")
    );
    this.elements.searchInput?.addEventListener("input", (e) =>
      this.handleSearch(e)
    );

    // Event listeners para el formulario
    this.elements.form?.addEventListener("submit", (e) =>
      this.handleFormSubmit(e)
    );

    // Event listeners para datos personales
    Object.entries(this.elements.personalData).forEach(([field, element]) => {
      element?.addEventListener("input", () => this.validatePersonalData());
    });

    // Event listeners para calculadora
    this.initializeCalculatorListeners();

    // Event listener para scroll infinito
    const boletosContainer = document.querySelector(".boletos-container");
    boletosContainer?.addEventListener("scroll", () =>
      this.handleInfiniteScroll(boletosContainer)
    );
  }

  /**
   * Inicializa los event listeners de la calculadora
   */
  initializeCalculatorListeners() {
    const calc = this.elements.calculator;

    if (calc.minus && calc.plus && calc.quantity) {
      calc.minus.addEventListener("click", () =>
        this.updateCalculatorQuantity("decrease")
      );
      calc.plus.addEventListener("click", () =>
        this.updateCalculatorQuantity("increase")
      );
      calc.quantity.addEventListener("change", (e) =>
        this.handleQuantityChange(e)
      );
    }

    calc.currencyRadios.forEach((radio) => {
      radio.addEventListener("change", (e) =>
        this.updateCurrency(e.target.value)
      );
    });
  }

  /**
   * Maneja el scroll infinito
   */
  handleInfiniteScroll(container) {
    if (
      container.scrollHeight - container.scrollTop <=
      container.clientHeight + 100
    ) {
      this.loadMoreBoletos();
    }
  }

  /**
   * Actualiza la cantidad máxima de selección
   */
  updateMaxSelection(action) {
    const min = 1;
    const max = 20;

    if (action === "decrease" && this.state.maxSelection > min) {
      this.state.maxSelection--;
    } else if (action === "increase" && this.state.maxSelection < max) {
      this.state.maxSelection++;
    }

    if (this.elements.currentCount) {
      this.elements.currentCount.textContent = this.state.maxSelection;
    }
    this.updateUI();
  }

  /**
   * Maneja la búsqueda de boletos
   */
  handleSearch(event) {
    const searchValue = event.target.value.trim();

    if (!this.elements.boletosGrid) return;

    if (searchValue) {
      const numero = parseInt(searchValue);
      if (!isNaN(numero) && numero > 0 && numero <= this.state.totalBoletos) {
        this.renderSearchResult(numero);
      }
    } else {
      this.resetBoletosGrid();
    }
  }

  /**
   * Renderiza el resultado de búsqueda
   */
  renderSearchResult(numero) {
    this.elements.boletosGrid.innerHTML = "";
    const numeroStr = numero.toString().padStart(4, "0");
    const boleto = this.createBoletoElement(numeroStr);
    this.elements.boletosGrid.appendChild(boleto);
  }

  /**
   * Crea un elemento de boleto
   */
  createBoletoElement(numero) {
    const boleto = document.createElement("div");
    boleto.className = "boleto";
    boleto.setAttribute("data-numero", numero);

    if (this.state.selectedBoletos.has(numero)) {
      boleto.classList.add("selected");
    }

    boleto.innerHTML = `<span>${numero}</span>`;
    boleto.onclick = () => this.toggleBoleto(numero, boleto);

    return boleto;
  }

  /**
   * Resetea la cuadrícula de boletos
   */
  resetBoletosGrid() {
    if (this.elements.boletosGrid) {
      this.elements.boletosGrid.innerHTML = "";
      this.state.lastLoadedBoleto = 0;
      this.loadMoreBoletos();
    }
  }

  /**
   * Carga más boletos
   */
  async loadMoreBoletos() {
    if (
      this.state.isLoading ||
      this.state.lastLoadedBoleto >= this.state.totalBoletos
    )
      return;

    this.state.isLoading = true;
    const fragment = document.createDocumentFragment();
    const start = this.state.lastLoadedBoleto + 1;
    const end = Math.min(start + this.state.batchSize, this.state.totalBoletos);

    for (let i = start; i <= end; i++) {
      const numero = i.toString().padStart(4, "0");
      const boleto = this.createBoletoElement(numero);
      fragment.appendChild(boleto);
    }

    this.elements.boletosGrid?.appendChild(fragment);
    this.state.lastLoadedBoleto = end;
    this.state.isLoading = false;

    await this.cargarEstadoBoletos();
  }

  /**
   * Alterna la selección de un boleto
   */
  async toggleBoleto(numero, element) {
    if (!element) return;

    if (this.state.selectedBoletos.has(numero)) {
      this.state.selectedBoletos.delete(numero);
      element.classList.remove("selected");
    } else if (this.state.selectedBoletos.size < this.state.maxSelection) {
      try {
        const disponible = await this.verificarDisponibilidad(numero);
        if (disponible) {
          this.state.selectedBoletos.add(numero);
          element.classList.add("selected");
        } else {
          this.mostrarError("Este boleto ya no está disponible");
          element.classList.add("vendido");
          element.disabled = true;
        }
      } catch (error) {
        this.mostrarError("Error al verificar disponibilidad");
      }
    }

    this.updateUI();
  }

  /**
   * Verifica la disponibilidad de un boleto
   */
  async verificarDisponibilidad(numero) {
    try {
      const response = await fetch("/boletos/verificar", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ numero }),
      });

      if (!response.ok) throw new Error("Error en la respuesta del servidor");

      const data = await response.json();
      return data.disponible;
    } catch (error) {
      console.error("Error al verificar disponibilidad:", error);
      return false;
    }
  }

  /**
   * Carga el estado de los boletos
   */
  async cargarEstadoBoletos() {
    try {
      const response = await fetch("/boletos/estado");
      if (!response.ok) throw new Error("Error al obtener estado de boletos");

      const data = await response.json();
      this.actualizarEstadoBoletos(data);
    } catch (error) {
      console.error("Error al cargar estado de boletos:", error);
    }
  }

  /**
   * Actualiza el estado visual de los boletos
   */
  actualizarEstadoBoletos(data) {
    data.forEach((boleto) => {
      const elemento = document.querySelector(
        `[data-numero="${boleto.numero_boleto}"]`
      );
      if (elemento) {
        if (boleto.estado === "vendido") {
          elemento.classList.add("vendido");
          elemento.disabled = true;
        } else if (boleto.estado === "reservado") {
          elemento.classList.add("reservado");
        }
      }
    });
  }

  /**
   * Actualiza la interfaz de usuario
   */
  updateUI() {
    if (
      !this.elements.selectedCounter ||
      !this.elements.totalAmount ||
      !this.elements.continueBtn
    )
      return;

    // Actualizar contador
    this.elements.selectedCounter.textContent = `${this.state.selectedBoletos.size} de ${this.state.maxSelection}`;

    // Actualizar total
    const total = this.state.selectedBoletos.size * this.state.pricePerBoleto;
    this.elements.totalAmount.textContent = `${total.toFixed(2)} USD`;

    // Actualizar campos ocultos
    document.getElementById("total_amount_input").value = total.toFixed(2);
    document.getElementById("selected_boletos_input").value = JSON.stringify(
      Array.from(this.state.selectedBoletos)
    );

    // Actualizar botón continuar
    const isFormValid = this.validateForm();

    if (this.elements.continueBtn) {
      this.elements.continueBtn.disabled = !isFormValid;
      this.elements.continueBtn.style.opacity = isFormValid ? "1" : "0.5";
      this.elements.continueBtn.style.backgroundColor = isFormValid
        ? "#0000FF"
        : "#0000FF";
    }

    // Actualizar números seleccionados
    this.renderSelectedNumbers();

    // Actualizar progreso
    this.updateProgress();
  }

  validateForm() {
    return (
      this.state.selectedBoletos.size >= this.state.maxSelection &&
      this.state.progress.nombre &&
      this.state.progress.identificacion &&
      this.state.progress.celular &&
      this.state.progress.ubicacion
    );
  }

  /**
   * Renderiza los números seleccionados
   */
  renderSelectedNumbers() {
    if (!this.elements.selectedNumbers) return;

    this.elements.selectedNumbers.innerHTML = "";
    Array.from(this.state.selectedBoletos)
      .sort((a, b) => parseInt(a) - parseInt(b))
      .forEach((numero) => {
        const div = document.createElement("div");
        div.className = "selected-number";
        div.innerHTML = `
          ${numero}
          <button onclick="boletosManager.removeNumber('${numero}')">&times;</button>
        `;
        this.elements.selectedNumbers.appendChild(div);
      });
  }

  /**
   * Remueve un número seleccionado
   */
  removeNumber(numero) {
    this.state.selectedBoletos.delete(numero);
    const boleto = this.elements.boletosGrid?.querySelector(
      `[data-numero="${numero}"]`
    );
    if (boleto) {
      boleto.classList.remove("selected");
    }
    this.updateUI();
  }

  /**
   * Actualiza el progreso
   */
  updateProgress() {
    const boletosProgress =
      (this.state.selectedBoletos.size / this.state.maxSelection) * 30;
    let completedSteps = boletosProgress;

    if (this.state.progress.nombre) completedSteps += 20;
    if (this.state.progress.identificacion) completedSteps += 20;
    if (this.state.progress.celular) completedSteps += 15;
    if (this.state.progress.ubicacion) completedSteps += 15;

    const progress = Math.min(completedSteps, 100);

    const progressActual = document.querySelector(".progress-actual");
    const progressPercent = document.getElementById("progress-percent");

    if (progressActual && progressPercent) {
      progressActual.style.width = `${progress}%`;
      progressPercent.style.left = `${progress}%`;
      progressPercent.textContent = `${progress.toFixed(1)}%`;
    }
  }

  /**
   * Valida los datos personales
   */
  validatePersonalData() {
    const data = this.elements.personalData;

    this.state.progress.nombre = data.nombre?.value.length > 0;
    this.state.progress.identificacion = data.identification?.value.length > 0;
    this.state.progress.celular = data.celular?.value.length > 0;
    this.state.progress.ubicacion = data.ubicacion?.value !== "";

    this.updateUI();
  }

  /**
   * Maneja el envío del formulario
   */
  async handleFormSubmit(event) {
    event.preventDefault();

    const boletos = Array.from(this.state.selectedBoletos);
    const total = boletos.length * this.state.pricePerBoleto;

    try {
      const response = await fetch("/boletos/procesar", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          boletos: boletos,
          total: total,
        }),
      });

      const data = await response.json();

      if (data.success) {
        alert("Compra procesada exitosamente");
        window.location.reload();
      } else {
        this.mostrarError(data.error || "Error al procesar la compra");
      }
    } catch (error) {
      console.error("Error:", error);
      this.mostrarError("Error al procesar la compra");
    }
  }

  /**
   * Muestra un mensaje de error
   */
  mostrarError(mensaje) {
    // Aquí puedes implementar tu propia lógica de mostrar errores
    alert(mensaje);
  }

  /**
   * Inicializa la aplicación
   */
  initializeApp() {
    this.loadMoreBoletos();
    this.updateUI();
    this.cargarEstadoBoletos();
  }
}

// Inicializar la aplicación
const boletosManager = new BoletosManager();

// Exponer la instancia globalmente para los event listeners inline
window.boletosManager = boletosManager;

// ==============================================
// SECCIÓN DE PAGOS
// ==============================================
document.addEventListener("DOMContentLoaded", function () {
  // Elementos y variables
  const btnMinusCal = document.getElementById("btnMinusCal");
  const btnPlusCal = document.getElementById("btnPlusCal");
  const ticketQty = document.getElementById("ticketQtyID");
  const montoTotalCal = document.getElementById("montoTotalCal");
  const montoTotalCalFormatt = document.getElementById("montoTotalCalFormatt");
  const other = document.getElementById("other");
  const QtyNumberPrice = document.getElementById("QtyNumberPrice");
  const currencyRadios = document.querySelectorAll('input[name="currency"]');
  const currencyCode = document.querySelectorAll(".currencyCode");
  const changeRate = document.querySelector(".changeRate");

  // Variables
  let currentQty = 3;
  let currentCurrency = "BS";
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
    currencyCode.forEach((el) => (el.textContent = currency));

    // Aquí podrías hacer una llamada a una API para obtener la tasa de cambio actual
    switch (currency) {
      case "BS":
        currentRate = 106.31;
        break;
      case "COP":
        currentRate = 4000;
        break;
      case "CLP":
        currentRate = 900;
        break;
    }

    changeRate.textContent = currentRate.toFixed(2);
    updateCalculations();
  }

  // Event Listeners
  btnMinusCal.addEventListener("click", () => {
    if (currentQty > 3) {
      currentQty--;
      ticketQty.value = currentQty;
      updateCalculations();
    }
  });

  btnPlusCal.addEventListener("click", () => {
    if (currentQty < 1000) {
      currentQty++;
      ticketQty.value = currentQty;
      updateCalculations();
    }
  });

  ticketQty.addEventListener("change", (e) => {
    const value = parseInt(e.target.value);
    if (value >= 3 && value <= 1000) {
      currentQty = value;
      updateCalculations();
    } else {
      e.target.value = currentQty;
    }
  });

  currencyRadios.forEach((radio) => {
    radio.addEventListener("change", (e) => {
      updateCurrency(e.target.value);
    });
  });

  // Inicialización
  updateCalculations();
});

// Función para mostrar detalles de pago
function showPaymentDetails(paymentId) {
  const paymentOptions = document.querySelectorAll(".option-payment");
  paymentOptions.forEach((option) => {
    option.classList.remove("selected");
  });

  const selectedOption = document.getElementById(paymentId);
  selectedOption.classList.add("selected");

  // Aquí podrías agregar la lógica para mostrar los detalles específicos del método de pago seleccionado
  const datosBanco = document.getElementById("datosBanco");
  const paymentTitle = datosBanco.querySelector("h6 span:first-child");

  switch (paymentId) {
    case "2":
      paymentTitle.textContent = "PAGO MOVIL";
      break;
    case "3":
      paymentTitle.textContent = "ZELLE";
      break;
    case "4":
      paymentTitle.textContent = "ZINLI";
      break;
    // Agregar más casos según sea necesario
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const searchTicket = document.getElementById("searchTicket");
  const findTicket = document.getElementById("findTicket");
  const resultTickets = document.getElementById("resultTickets");

  searchTicket.addEventListener("click", function () {
    const searchValue = findTicket.value.trim();
    if (searchValue) {
      // Aquí iría tu lógica de búsqueda
      resultTickets.style.display = "block";
    }
  });

  findTicket.addEventListener("keypress", function (e) {
    if (e.key === "Enter") {
      searchTicket.click();
    }
  });
});

function changeViewTicket(event) {
  const numbersContain = document.getElementById("numbersContain");
  const ticketsContain = document.getElementById("ticketsContain");

  if (event.target.checked) {
    numbersContain.style.display = "block";
    ticketsContain.style.display = "none";
  } else {
    numbersContain.style.display = "none";
    ticketsContain.style.display = "block";
  }
}

// Mejorar la visualización del select de código de país
document.addEventListener("DOMContentLoaded", function () {
  const countrySelect = document.getElementById("country_code");

  if (countrySelect) {
    // Formatear las opciones para mostrar las banderas correctamente
    Array.from(countrySelect.options).forEach((option) => {
      const icon = option.getAttribute("data-icon");
      const text = option.textContent;
      option.textContent = `${icon} ${text}`;
    });

    // Ajustar el ancho del select basado en el contenido
    function adjustSelectWidth() {
      const selected = countrySelect.options[countrySelect.selectedIndex];
      const tempSpan = document.createElement("span");
      tempSpan.style.display = "inline-block";
      tempSpan.style.visibility = "hidden";
      tempSpan.style.position = "fixed";
      tempSpan.style.padding = window.getComputedStyle(countrySelect).padding;
      tempSpan.style.font = window.getComputedStyle(countrySelect).font;
      tempSpan.textContent = selected.textContent;
      document.body.appendChild(tempSpan);
      const width = tempSpan.getBoundingClientRect().width;
      document.body.removeChild(tempSpan);
      countrySelect.style.width = `${width + 40}px`; // 40px extra para el ícono de flecha
    }

    // Ajustar ancho inicial y en cambios
    adjustSelectWidth();
    countrySelect.addEventListener("change", adjustSelectWidth);
  }
});
