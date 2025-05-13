document.addEventListener("DOMContentLoaded", function () {
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
  const boletosContainer = document.querySelector(".boletos-container");
  const boletosList = document.getElementById("boletosList");
  const loadingText = document.querySelector(".loading-text");
  const buscador = document.getElementById("buscador");
  const btnRandomNumber = document.getElementById("btnRandomNumber");
  const numeroBoletosSpan = document.querySelector(".numero-boletos");
  const totalUSDSpan = document.getElementById("totalUSD");
  const btnMenos = document.querySelector(".btn-circle:first-of-type");
  const btnMas = document.querySelector(".btn-circle:last-of-type");

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
    loadingText.classList.add("visible");

    const inicio = todosLosBoletos.length + 1;
    const fin = Math.min(inicio + boletosPorPagina - 1, totalBoletos);

    const fragment = document.createDocumentFragment();
    for (let i = inicio; i <= fin; i++) {
      const numero = i.toString().padStart(4, "0");
      const boleto = document.createElement("div");
      boleto.className = "boleto";
      boleto.textContent = numero;
      boleto.dataset.numero = numero;
      boleto.onclick = function () {
        toggleBoleto(this, numero);
      };
      fragment.appendChild(boleto);
      todosLosBoletos.push(boleto);
    }

    boletosList.appendChild(fragment);

    setTimeout(() => {
      cargandoBoletos = false;
      loadingText.classList.remove("visible");
    }, 300);

    // Mostrar mensaje cuando se hayan cargado todos los boletos
    if (todosLosBoletos.length >= totalBoletos) {
      loadingText.textContent = "Has llegado al final de la lista";
      loadingText.classList.add("visible");
      setTimeout(() => loadingText.classList.remove("visible"), 2000);
    }
  }

  // Manejador del scroll del contenedor
  function handleScroll() {
    const { scrollTop, scrollHeight, clientHeight } = boletosContainer;
    if (scrollHeight - scrollTop - clientHeight < 300) {
      cargarMasBoletos();
    }
  }

  // Agregar el evento de scroll al contenedor
  boletosContainer.addEventListener("scroll", handleScroll);

  // Cargar los primeros boletos
  cargarMasBoletos();

  // Manejadores para los botones + y -
  btnMenos.addEventListener("click", () => {
    if (cantidadSeleccion > minBoletos) {
      cantidadSeleccion--;
      numeroBoletosSpan.textContent = cantidadSeleccion;
      actualizarTotal();
    }
  });

  btnMas.addEventListener("click", () => {
    if (cantidadSeleccion < 10000) {
      // Aumentado a 10000 boletos máximo
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
    const totalUSDDisplay = document.getElementById("totalUSD");
    if (totalUSDDisplay) {
      totalUSDDisplay.textContent = `${totalUSD.toFixed(2)} USD`;
    }

    // Actualizar el total en BS en el formulario de datos personales
    const totalBSDisplay = document.getElementById("totalBSDisplay");
    if (totalBSDisplay) {
      totalBSDisplay.textContent = `${totalBS.toFixed(2)} BS`;
    }
  }

  // Función para actualizar los chips de boletos seleccionados
  function actualizarChipsBoletos() {
    const contenedor = document.querySelector(".boletos-seleccionados-chips");
    contenedor.innerHTML = "";

    Array.from(boletosSeleccionados)
      .sort()
      .forEach((numero) => {
        const chip = document.createElement("div");
        chip.className = "boleto-chip";

        const numeroSpan = document.createElement("span");
        numeroSpan.textContent = numero;

        const removeButton = document.createElement("button");
        removeButton.className = "chip-remove";
        removeButton.innerHTML = "×";
        removeButton.onclick = (e) => {
          e.stopPropagation();
          const boleto = document.querySelector(
            `.boleto[data-numero="${numero}"]`
          );
          if (boleto) {
            toggleBoleto(boleto, numero);
          }
        };

        chip.appendChild(numeroSpan);
        chip.appendChild(removeButton);
        contenedor.appendChild(chip);
      });

    // Actualizar el contador
    const contador = document.querySelector(".contador");
    contador.textContent = `${boletosSeleccionados.size} de ${cantidadSeleccion}`;
  }

  // Función para alternar selección de boleto
  function toggleBoleto(elemento, numero) {
    if (elemento.classList.contains("selected")) {
      elemento.classList.remove("selected");
      boletosSeleccionados.delete(numero);
    } else {
      elemento.classList.add("selected");
      boletosSeleccionados.add(numero);
    }
    actualizarContador();
    actualizarTotal();
    actualizarChipsBoletos();
  }

  // Función para elegir boletos al azar
  function elegirBoletosAlAzar() {
    boletosSeleccionados.clear();
    document
      .querySelectorAll(".boleto.selected")
      .forEach((b) => b.classList.remove("selected"));
    document.querySelector(".boletos-seleccionados-chips").innerHTML = ""; // Limpiar chips

    const boletosDisponibles = Array.from(todosLosBoletos).filter(
      (b) => !b.classList.contains("disabled")
    );

    if (boletosDisponibles.length < cantidadSeleccion) {
      alert("No hay suficientes boletos disponibles");
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
        boletoSeleccionado.classList.add("selected");
        boletosSeleccionados.add(boletoSeleccionado.dataset.numero);
        actualizarContadorSeleccionados();
        actualizarChipsBoletos(); // Actualizar chips con retraso
      }, i * 200);

      boletosDisponibles.splice(indiceAleatorio, 1);
    }
  }

  // Actualizar el contador de seleccionados
  function actualizarContadorSeleccionados() {
    const contadorElement = document.querySelector(".contador");
    contadorElement.textContent = `${boletosSeleccionados.size} de ${cantidadSeleccion}`;
  }

  // Evento para el botón de elegir a la suerte
  btnRandomNumber.addEventListener("click", elegirBoletosAlAzar);

  // Función de búsqueda en tiempo real
  function filtrarBoletos(busqueda) {
    busqueda = busqueda.trim();

    todosLosBoletos.forEach((boleto) => {
      const numeroBoleto = boleto.dataset.numero;
      if (busqueda === "") {
        // Si no hay búsqueda, mostrar todos
        boleto.style.display = "";
        boleto.style.order = ""; // Restaurar orden original
      } else if (numeroBoleto.startsWith(busqueda)) {
        // Si el número coincide con la búsqueda, mostrar
        boleto.style.display = "";
        boleto.style.order = "1"; // Mover al principio
      } else {
        // Si no coincide, ocultar
        boleto.style.display = "none";
        boleto.style.order = "2";
      }
    });
  }

  // Evento de entrada en el buscador (tiempo real)
  buscador.addEventListener("input", function (e) {
    filtrarBoletos(e.target.value);
  });

  // Evento del botón buscar
  document.querySelector(".btn-buscar").onclick = function () {
    filtrarBoletos(buscador.value);
  };

  function actualizarContador() {
    const contador = document.querySelector(".contador");
    contador.textContent = `${boletosSeleccionados.size} de ${cantidadSeleccion}`;
  }

  // Verificar disponibilidad de boletos seleccionados
  async function verificarBoletosSeleccionados() {
    const boletosArray = Array.from(boletosSeleccionados);
    console.log("Boletos seleccionados para verificar:", boletosArray);

    try {
      const response = await fetch("/TuRifadigi/verificarDisponibilidad", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
          "Cache-Control": "no-cache",
        },
        body: JSON.stringify({
          boletos: boletosArray,
        }),
      });

      if (!response.ok) {
        throw new Error(`Error HTTP: ${response.status}`);
      }

      const responseText = await response.text();

      if (!responseText.trim()) {
        throw new Error("Respuesta vacía del servidor");
      }

      const data = JSON.parse(responseText);

      if (!data.disponibles || !Array.isArray(data.disponibles)) {
        throw new Error("Formato de respuesta inválido");
      }

      const boletosNoDisponibles = data.disponibles
        .filter((b) => !b.disponible)
        .map((b) => b.numero);

      if (boletosNoDisponibles.length > 0) {
        alert(
          `Los siguientes boletos no están disponibles: ${boletosNoDisponibles.join(
            ", "
          )}`
        );
        return false;
      }

      return true;
    } catch (error) {
      console.error("Error en verificación:", error);
      alert(
        "Error al verificar la disponibilidad de los boletos: " + error.message
      );
      return false;
    }
  }

  // Continuar con el proceso
  document.querySelector(".btn-continuar").onclick = function () {
    if (boletosSeleccionados.size < minBoletos) {
      alert("Debe seleccionar al menos 2 boletos para continuar");
      return;
    }
    document.getElementById("datosPersonales").style.display = "block";
    this.parentElement.style.display = "none";
  };

  // Manejar el envío del formulario
  document.querySelector(".btn-confirmar").onclick = async function (e) {
    e.preventDefault();

    // Validar campos requeridos
    const nombre = document.getElementById("nombre").value.trim();
    const cedula = document.getElementById("cedula").value.trim();
    const telefono = document.getElementById("telefono").value.trim();
    const ubicacion = document.getElementById("ubicacion").value.trim();
    const titular = document.getElementById("titular").value.trim();
    const referencia = document.getElementById("referencia").value.trim();
    const metodoPago = document.getElementById("metodoPago").value;

    if (
      !nombre ||
      !cedula ||
      !telefono ||
      !ubicacion ||
      !titular ||
      !referencia
    ) {
      alert("Por favor complete todos los campos requeridos");
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
        metodo_pago: metodoPago,
      };

      const responseCompra = await fetch("/TuRifadigi/procesarCompra", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(datosCompra),
      });

      const dataCompra = await responseCompra.json();

      if (dataCompra.success) {
        // Después de procesar la compra, verificamos la disponibilidad
        const responseVerificacion = await fetch(
          "/TuRifadigi/verificarDisponibilidad",
          {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              boletos: Array.from(boletosSeleccionados),
            }),
          }
        );

        const dataVerificacion = await responseVerificacion.json();
        const boletosNoDisponibles = dataVerificacion.disponibles
          .filter((b) => !b.disponible)
          .map((b) => b.numero);

        if (boletosNoDisponibles.length > 0) {
          alert(
            `Los siguientes boletos ya no están disponibles: ${boletosNoDisponibles.join(
              ", "
            )}`
          );
          return;
        }

        alert("¡Compra procesada correctamente!");
        window.location.reload();
      } else {
        alert(dataCompra.error || "Error al procesar la compra");
      }
    } catch (error) {
      console.error("Error:", error);
      alert("Ocurrió un error al procesar la solicitud");
    }
  };

  // Conversor de moneda
  document
    .querySelectorAll(".conversor-controls .btn-circle-custom")
    .forEach((btn) => {
      btn.onclick = function () {
        const input = this.parentElement.querySelector("input");
        const valor = parseInt(input.value);
        if (this.textContent === "+" && valor < 500) {
          input.value = valor + 1;
        } else if (this.textContent === "-" && valor > 1) {
          input.value = valor - 1;
        }
        actualizarTotal();
      };
    });

  // Subir comprobante
  document.querySelector(".btn-upload").onclick = function () {
    const input = document.createElement("input");
    input.type = "file";
    input.accept = "image/*";
    input.onchange = function (e) {
      const file = e.target.files[0];
      if (file) {
        console.log("Imagen seleccionada:", file.name);
      }
    };
    input.click();
  };

  // Actualizar estilos para el botón de remover en el chip
  const styles = document.createElement("style");
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
