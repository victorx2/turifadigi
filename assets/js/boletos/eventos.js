(function (app) {
  app.eventos = {
    init: function () {
      // Referencias DOM
      app.dom = {
        boletosContainer: document.querySelector(".boletos-container"),
        boletosList: document.getElementById("boletosList"),
        loadingText: document.querySelector(".loading-text"),
        buscador: document.getElementById("buscador"),
        btnRandomNumber: document.getElementById("btnRandomNumber"),
        numeroBoletosSpan: document.querySelector(".numero-boletos"),
        totalUSDSpan: document.getElementById("totalUSD"),
        btnMenos: document.querySelector(".btn-circle:first-of-type"),
        btnMas: document.querySelector(".btn-circle:last-of-type"),
      };

      // Eventos de scroll
      app.dom.boletosContainer.addEventListener("scroll", this.handleScroll);

      // Eventos de botones
      app.dom.btnRandomNumber.addEventListener(
        "click",
        app.boletos.elegirBoletosAlAzar
      );
      app.dom.btnMenos.addEventListener("click", this.handleBtnMenos);
      app.dom.btnMas.addEventListener("click", this.handleBtnMas);

      // Eventos de búsqueda
      app.dom.buscador.addEventListener("input", (e) =>
        app.boletos.filtrarBoletos(e.target.value)
      );
      document.querySelector(".btn-buscar").onclick = () =>
        app.boletos.filtrarBoletos(app.dom.buscador.value);

      // Eventos de formulario
      document.querySelector(".btn-continuar").onclick =
        app.ui.mostrarFormularioDatos;
      document.querySelector(".btn-confirmar").onclick = this.handleConfirmar;

      // Eventos de conversor
      document
        .querySelectorAll(".conversor-controls .btn-circle-custom")
        .forEach((btn) => {
          btn.onclick = this.handleConversor;
        });

      // Evento de subida de comprobante
      document.querySelector(".btn-upload").onclick = this.handleUpload;
    },

    handleScroll: function () {
      const { scrollTop, scrollHeight, clientHeight } =
        app.dom.boletosContainer;
      if (scrollHeight - scrollTop - clientHeight < 300) {
        app.boletos.cargarMasBoletos();
      }
    },

    handleBtnMenos: function () {
      if (app.config.cantidadSeleccion > app.config.minBoletos) {
        app.config.cantidadSeleccion--;
        app.dom.numeroBoletosSpan.textContent = app.config.cantidadSeleccion;
        app.pagos.actualizarTotal();
      }
    },

    handleBtnMas: function () {
      if (app.config.cantidadSeleccion < 10000) {
        app.config.cantidadSeleccion++;
        app.dom.numeroBoletosSpan.textContent = app.config.cantidadSeleccion;
        app.pagos.actualizarTotal();
      }
    },

    handleConfirmar: async function (e) {
      e.preventDefault();

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

      const totalUSD =
        app.config.boletosSeleccionados.size * app.config.precioUnitarioUSD;
      const totalBS = totalUSD * app.config.tasaUSD;

      const datosCompra = {
        boletos: Array.from(app.config.boletosSeleccionados),
        nombre: nombre,
        cedula: cedula,
        telefono: telefono,
        ubicacion: ubicacion,
        total: totalBS,
        titular: titular,
        referencia: referencia,
        metodo_pago: metodoPago,
      };

      await app.pagos.procesarCompra(datosCompra);
    },

    handleConversor: function () {
      const input = this.parentElement.querySelector("input");
      const valor = parseInt(input.value);
      if (this.textContent === "+" && valor < 500) {
        input.value = valor + 1;
      } else if (this.textContent === "-" && valor > 1) {
        input.value = valor - 1;
      }
      app.pagos.actualizarTotal();
    },

    handleUpload: function () {
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
    },
  };
})(window.TuRifadigi);
