$(document).ready(function () {
  $(".ui.dropdown").each(function () {
    const dropdown = $(this);
    const input = dropdown.find("input.search");
    const menu = dropdown.find(".menu");
    const items = menu.find(".item");
    const hiddenInput = dropdown.find('input[type="hidden"]');
    const defaultText = dropdown.find(".default.text");

    // Función para filtrar items
    function filterItems(searchText) {
      items.each(function () {
        const item = $(this);
        const text = item.text().toLowerCase();
        item.toggle(text.includes(searchText.toLowerCase()));
      });
    }

    // Manejar clic en el dropdown
    dropdown.on("click", function (e) {
      e.stopPropagation();

      // Si ya está activo y se hace clic en el input, no hacer nada
      if ($(e.target).is("input.search") && dropdown.hasClass("active")) {
        return;
      }

      // Toggle dropdown
      $(".ui.dropdown").not(this).removeClass("active");
      dropdown.toggleClass("active");

      if (dropdown.hasClass("active")) {
        input.focus();
        filterItems(""); // Mostrar todos los items al abrir
      }
    });

    // Manejar búsqueda
    input.on("input", function (e) {
      e.stopPropagation();
      filterItems(this.value);
    });

    // Manejar selección de item
    items.on("click", function (e) {
      e.stopPropagation();
      const item = $(this);
      const value = item.data("value");
      const text = item.text();

      // Actualizar texto visible y valor oculto
      defaultText.text(text).removeClass("default");
      hiddenInput.val(value);

      // Actualizar estado visual
      items.removeClass("selected");
      item.addClass("selected");

      // Cerrar dropdown y limpiar búsqueda
      dropdown.removeClass("active");
      input.val("");
      filterItems("");

      // Trigger change event
      hiddenInput.trigger("change");
    });

    // Cerrar al hacer clic fuera
    $(document).on("click", function (e) {
      if (!$(e.target).closest(".ui.dropdown").length) {
        dropdown.removeClass("active");
        input.val("");
        filterItems("");
      }
    });

    // Prevenir que las teclas de navegación cierren el dropdown
    input.on("keydown", function (e) {
      if (e.key === "ArrowUp" || e.key === "ArrowDown") {
        e.preventDefault();
      }
    });
  });
});
