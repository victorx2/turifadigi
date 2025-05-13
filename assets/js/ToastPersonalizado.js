const ToastPersonalizado = {
  mostrar: function (titulo, mensaje, duracion = 3000) {
    Toastify({
      text: `${titulo}\n${mensaje}`,
      duration: duracion,
      gravity: "top",
      position: "right",
      stopOnFocus: true,
      close: true,
      style: {
        fontWeight: "500",
      },
    }).showToast();
  },

  exito: function (titulo, mensaje) {
    this.mostrar(titulo, mensaje);
  },

  error: function (titulo, mensaje) {
    this.mostrar(titulo, mensaje);
  },

  info: function (titulo, mensaje) {
    this.mostrar(titulo, mensaje);
  },

  advertencia: function (titulo, mensaje) {
    this.mostrar(titulo, mensaje);
  },
};
