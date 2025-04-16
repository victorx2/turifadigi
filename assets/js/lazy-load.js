document.addEventListener("DOMContentLoaded", function () {
  // Configuración del Intersection Observer
  const observerOptions = {
    root: null,
    rootMargin: "50px",
    threshold: 0.1,
  };

  // Función para cargar imágenes de fondo
  function loadBackgroundImage(element) {
    const bgImage = element.getAttribute("data-bg");
    if (bgImage) {
      element.style.backgroundImage = `url(${bgImage})`;
      element.removeAttribute("data-bg");
    }
  }

  // Crear el observer
  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        loadBackgroundImage(entry.target);
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  // Observar todos los elementos con data-bg
  document.querySelectorAll("[data-bg]").forEach((element) => {
    observer.observe(element);
  });
});
