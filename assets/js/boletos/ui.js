(function (app) {
  app.ui = {
    actualizarChipsBoletos: function () {
      const contenedor = document.querySelector(".boletos-seleccionados-chips");
      contenedor.innerHTML = "";

      Array.from(app.config.boletosSeleccionados)
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
              app.boletos.toggleBoleto(boleto, numero);
            }
          };

          chip.appendChild(numeroSpan);
          chip.appendChild(removeButton);
          contenedor.appendChild(chip);
        });

      this.actualizarContador();
    },

    actualizarContador: function () {
      const contador = document.querySelector(".contador");
      contador.textContent = `${app.config.boletosSeleccionados.size} de ${app.config.cantidadSeleccion}`;
    },

    actualizarContadorSeleccionados: function () {
      const contadorElement = document.querySelector(".contador");
      contadorElement.textContent = `${app.config.boletosSeleccionados.size} de ${app.config.cantidadSeleccion}`;
    },

    mostrarFormularioDatos: function () {
      if (app.config.boletosSeleccionados.size < app.config.minBoletos) {
        alert("Debe seleccionar al menos 2 boletos para continuar");
        return;
      }
      document.getElementById("datosPersonales").style.display = "block";
      document.querySelector(".seleccionados-container").style.display = "none";
    },

    initStyles: function () {
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
    },
  };
})(window.TuRifadigi);
