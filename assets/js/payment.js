// Datos de los métodos de pago
const paymentData = {
  zelle: {
    title: "ZELLE",
    details: ["Número de telefono: +1 4074287580"],
  },
  paypal: {
    title: "PAYPAL",
    details: [
      "Nombre: Yorsin Cruz Osorio",
      "Correo: Yorsincruz1995@gmail.com",
      "Usuario: @Yorsin0506",
      "Teléfono: +1 4074287580",
    ],
  },
  venezuela: {
    title: "BANCO DE VENEZUELA",
    details: ["Teléfono: 04124124923", "Cédula: 28517267"],
  },
  nesqui: {
    title: "NESQUI",
    details: ["Información próximamente"],
  },
};

// Función para mostrar los datos de pago
function mostrarDatosPago(method) {
  // Obtener elementos del DOM
  const paymentTitle = document.getElementById("paymentTitle");
  const paymentDetails = document.getElementById("paymentDetails");
  const paymentMethods = document.querySelectorAll(".payment-method");

  // Remover clase active de todos los métodos
  paymentMethods.forEach((method) => method.classList.remove("active"));

  // Agregar clase active al método seleccionado
  const selectedMethod = document.querySelector(
    `[onclick="mostrarDatosPago('${method}')"]`
  );
  if (selectedMethod) {
    selectedMethod.classList.add("active");
  }

  // Actualizar título y detalles
  if (paymentData[method]) {
    paymentTitle.textContent = paymentData[method].title;
    paymentDetails.innerHTML = paymentData[method].details
      .map((detail) => `<p>${detail}</p>`)
      .join("");
  }
}

// Inicializar con el primer método de pago
document.addEventListener("DOMContentLoaded", function () {
  mostrarDatosPago("pagoMovil");
});
