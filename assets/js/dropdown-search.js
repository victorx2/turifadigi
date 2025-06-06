$(document).ready(function () {
  // Delegación de eventos para abrir/cerrar el select
  $(document).on("click", ".custom-language-button", function (e) {
    e.stopPropagation();
    $(".custom-language-select")
      .not($(this).closest(".custom-language-select"))
      .removeClass("open");
    $(this).closest(".custom-language-select").toggleClass("open");
  });

  // Delegación de eventos para seleccionar idioma
  $(document).on("click", ".custom-language-option", function (e) {
    e.stopPropagation();
    const value = $(this).data("value");
    const text = $(this).text();

    // Actualizar todos los selects
    $(".custom-language-select").each(function () {
      $(this).find(".custom-language-option").removeClass("selected");
      $(this)
        .find(`.custom-language-option[data-value='${value}']`)
        .addClass("selected");
      $(this).find(".custom-language-selected").text(text);
      $(this).find('input[name="language"]').val(value);
      $(this).removeClass("open");
    });

    // Guardar y cambiar idioma
    localStorage.setItem("selectedLanguage", value);
    if (typeof i18n !== "undefined" && typeof i18n.changeLang === "function") {
      i18n.changeLang(value);
    }
  });

  // Cerrar al hacer clic fuera
  $(document).on("click", function () {
    $(".custom-language-select").removeClass("open");
  });

  // Inicializar selects con el idioma guardado
  function setInitialLanguage() {
    const saved = localStorage.getItem("selectedLanguage") || "es";
    $(".custom-language-select").each(function () {
      const initialOption = $(this).find(
        `.custom-language-option[data-value='${saved}']`
      );
      if (initialOption.length) {
        $(this).find(".custom-language-option").removeClass("selected");
        initialOption.addClass("selected");
        $(this).find(".custom-language-selected").text(initialOption.text());
        $(this).find('input[name="language"]').val(saved);
      }
    });
  }
  setInitialLanguage();

  // Sticky header: clona y elimina el select según el estado sticky
  let lastStickyState = false;
  function syncLanguageSelectToSticky() {
    const $original = $("#custom-language-select").first();
    const $stickyHeader = $(".stricky-header.stricked-menu.main-menu");
    if ($stickyHeader.length) {
      let $stickySelect = $stickyHeader.find("#custom-language-select");
      if ($stickySelect.length === 0) {
        $stickySelect = $original.clone();
        $stickyHeader.find(".main-menu__right").prepend($stickySelect);
        setInitialLanguage();
      }
    }
  }
  $(window).on("scroll", function () {
    const isSticky = $(".stricky-header.stricked-menu.main-menu").hasClass(
      "stricky-fixed"
    );
    if (isSticky && !lastStickyState) {
      syncLanguageSelectToSticky();
      lastStickyState = true;
    } else if (!isSticky && lastStickyState) {
      $(
        ".stricky-header.stricked-menu.main-menu #custom-language-select"
      ).remove();
      lastStickyState = false;
    }
  });
  if ($(".stricky-header.stricked-menu.main-menu").hasClass("stricky-fixed")) {
    syncLanguageSelectToSticky();
    lastStickyState = true;
  }
});
