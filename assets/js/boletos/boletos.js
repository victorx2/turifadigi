(function (app) {
  app.boletos = {
    cargarMasBoletos: async function () {
      if (
        app.config.cargandoBoletos ||
        app.config.todosLosBoletos.length >= app.config.totalBoletos
      )
        return;

      app.config.cargandoBoletos = true;
      app.dom.loadingText.classList.add("visible");

      const inicio = app.config.todosLosBoletos.length + 1;
      const fin = Math.min(
        inicio + app.config.boletosPorPagina - 1,
        app.config.totalBoletos
      );

      const fragment = document.createDocumentFragment();
      for (let i = inicio; i <= fin; i++) {
        const numero = i.toString().padStart(4, "0");
        const boleto = document.createElement("div");
        boleto.className = "boleto";
        boleto.textContent = numero;
        boleto.dataset.numero = numero;
        boleto.onclick = function () {
          app.boletos.toggleBoleto(this, numero);
        };
        fragment.appendChild(boleto);
        app.config.todosLosBoletos.push(boleto);
      }

      app.dom.boletosList.appendChild(fragment);

      setTimeout(() => {
        app.config.cargandoBoletos = false;
        app.dom.loadingText.classList.remove("visible");
      }, 300);

      if (app.config.todosLosBoletos.length >= app.config.totalBoletos) {
        app.dom.loadingText.textContent = "Has llegado al final de la lista";
        app.dom.loadingText.classList.add("visible");
        setTimeout(() => app.dom.loadingText.classList.remove("visible"), 2000);
      }
    },

    toggleBoleto: function (elemento, numero) {
      if (elemento.classList.contains("selected")) {
        elemento.classList.remove("selected");
        app.config.boletosSeleccionados.delete(numero);
      } else {
        elemento.classList.add("selected");
        app.config.boletosSeleccionados.add(numero);
      }
      app.ui.actualizarContador();
      app.pagos.actualizarTotal();
      app.ui.actualizarChipsBoletos();
    },

    elegirBoletosAlAzar: function () {
      app.config.boletosSeleccionados.clear();
      document
        .querySelectorAll(".boleto.selected")
        .forEach((b) => b.classList.remove("selected"));
      document.querySelector(".boletos-seleccionados-chips").innerHTML = "";

      const boletosDisponibles = Array.from(app.config.todosLosBoletos).filter(
        (b) => !b.classList.contains("disabled")
      );

      if (boletosDisponibles.length < app.config.cantidadSeleccion) {
        alert("No hay suficientes boletos disponibles");
        return;
      }

      for (let i = 0; i < app.config.cantidadSeleccion; i++) {
        let indiceAleatorio;
        let boletoSeleccionado;

        do {
          indiceAleatorio = Math.floor(
            Math.random() * boletosDisponibles.length
          );
          boletoSeleccionado = boletosDisponibles[indiceAleatorio];
        } while (
          app.config.boletosSeleccionados.has(boletoSeleccionado.dataset.numero)
        );

        setTimeout(() => {
          boletoSeleccionado.classList.add("selected");
          app.config.boletosSeleccionados.add(
            boletoSeleccionado.dataset.numero
          );
          app.ui.actualizarContadorSeleccionados();
          app.ui.actualizarChipsBoletos();
        }, i * 200);

        boletosDisponibles.splice(indiceAleatorio, 1);
      }
    },

    filtrarBoletos: function (busqueda) {
      busqueda = busqueda.trim();

      app.config.todosLosBoletos.forEach((boleto) => {
        const numeroBoleto = boleto.dataset.numero;
        if (busqueda === "") {
          boleto.style.display = "";
          boleto.style.order = "";
        } else if (numeroBoleto.startsWith(busqueda)) {
          boleto.style.display = "";
          boleto.style.order = "1";
        } else {
          boleto.style.display = "none";
          boleto.style.order = "2";
        }
      });
    },
  };
})(window.TuRifadigi);
