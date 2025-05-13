document.addEventListener("DOMContentLoaded", function () {
  // Inicializar estilos
  window.TuRifadigi.ui.initStyles();

  // Inicializar eventos
  window.TuRifadigi.eventos.init();

  // Cargar los primeros boletos
  window.TuRifadigi.boletos.cargarMasBoletos();
});
