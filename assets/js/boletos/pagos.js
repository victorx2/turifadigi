(function (app) {
  app.pagos = {
    actualizarTotal: function () {
      const totalUSD =
        app.config.boletosSeleccionados.size * app.config.precioUnitarioUSD;
      const totalBS = totalUSD * app.config.tasaUSD;

      const totalUSDDisplay = document.getElementById("totalUSD");
      if (totalUSDDisplay) {
        totalUSDDisplay.textContent = `${totalUSD.toFixed(2)} USD`;
      }

      const totalBSDisplay = document.getElementById("totalBSDisplay");
      if (totalBSDisplay) {
        totalBSDisplay.textContent = `${totalBS.toFixed(2)} BS`;
      }
    },

    verificarBoletosSeleccionados: async function () {
      const boletosArray = Array.from(app.config.boletosSeleccionados);
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
          "Error al verificar la disponibilidad de los boletos: " +
            error.message
        );
        return false;
      }
    },

    procesarCompra: async function (datosCompra) {
      try {
        const responseCompra = await fetch("/TuRifadigi/procesarCompra", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(datosCompra),
        });

        const dataCompra = await responseCompra.json();

        if (dataCompra.success) {
          const responseVerificacion = await fetch(
            "/TuRifadigi/verificarDisponibilidad",
            {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
              },
              body: JSON.stringify({
                boletos: Array.from(app.config.boletosSeleccionados),
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
            return false;
          }

          alert("¡Compra procesada correctamente!");
          window.location.reload();
          return true;
        } else {
          alert(dataCompra.error || "Error al procesar la compra");
          return false;
        }
      } catch (error) {
        console.error("Error:", error);
        alert("Ocurrió un error al procesar la solicitud");
        return false;
      }
    },
  };
})(window.TuRifadigi);
