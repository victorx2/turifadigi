// Sistema de traducciones

// Inicializar y sincronizar el idioma con localStorage y el select

document.addEventListener("DOMContentLoaded", () => {
  const languageSwitcher = document.getElementById("language-switcher");
  //console.log(
  //  "Tipo de languageSwitcher:",
  //  typeof languageSwitcher,
  //  "Valor:",
  //  languageSwitcher
  //);
  if (languageSwitcher) {
    //console.log("languageSwitcher encontrado en el DOM.");
    // Obtener el idioma guardado o usar español por defecto
    const savedLang = localStorage.getItem("language") || "es";
    // Establecer el valor del select según el idioma guardado
    languageSwitcher.value = savedLang;

    // Cambiar el idioma al cargar la página
    i18n.changeLang(savedLang);

    // Manejar cambios en el select
    languageSwitcher.addEventListener("change", function () {
      const selectedLang = this.value;
      localStorage.setItem("language", selectedLang);
      i18n.changeLang(selectedLang);
    });
  } else {
    console.log("languageSwitcher no encontrado en el DOM.");
  }
});

const i18n = {
  // Almacena las traducciones
  translations: {},
  // Idioma actual
  currentLang: "es",
  // Mapeo de idiomas a índices
  languageIndices: {
    es: 0,
    en: 1,
  },

  // Funciones de manejo de cookies
  setLanguageCookie(lang) {
    document.cookie = `language=${lang}; max-age=${365 * 24 * 60 * 60}; path=/`;
  },

  getLanguageCookie() {
    const name = "language=";
    const decodedCookie = decodeURIComponent(document.cookie);
    const ca = decodedCookie.split(";");
    for (let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) === " ") {
        c = c.substring(1);
      }
      if (c.indexOf(name) === 0) {
        return c.substring(name.length);
      }
    }
    return null;
  },

  // Funciones de manejo de localStorage
  saveLanguageToStorage(lang) {
    localStorage.setItem("language", lang);
  },

  getLanguageFromStorage() {
    return localStorage.getItem("language");
  },

  // Inicializar el sistema
  async init() {
    try {
      const esResponse = await fetch("assets/language/es.json");
      const enResponse = await fetch("assets/language/en.json");

      if (!esResponse.ok || !enResponse.ok) {
        throw new Error("No se encontraron los archivos de traducción");
      }

      // Intentar obtener el idioma de las cookies o localStorage
      const cookieLang = this.getLanguageCookie();
      const storageLang = this.getLanguageFromStorage();

      // Establecer el idioma actual con prioridad: cookie > localStorage > español por defecto
      this.currentLang = cookieLang || storageLang || "es";

      // Cargar las traducciones
      await this.loadTranslations(this.currentLang);

      // Inicializar el selector de idioma (esto actualizará el selector visualmente)
      this.initLanguageSwitcher();

      // Traducir la página
      this.translatePage();
    } catch (error) {
      alert(
        "No se encontraron los archivos de traducción. Por favor, verifica que existan es.json y en.json en la carpeta assets/language/"
      );
    }
  },

  // Cargar traducciones desde el archivo JSON
  async loadTranslations(lang) {
    try {
      const response = await fetch(`assets/language/${lang}.json`);
      if (!response.ok) {
        throw new Error(`No se encontró el archivo ${lang}.json`);
      }
      this.translations = await response.json();
    } catch (error) {
      alert(
        `Error cargando traducciones para ${lang}. Verifica que el archivo ${lang}.json exista y tenga el formato correcto.`
      );
    }
  },

  // Obtener una traducción
  t(key) {
    return this.translations[key] || key;
  },

  // Obtener índice del idioma actual
  getLanguageIndex(lang) {
    return this.languageIndices[lang] || 0;
  },

  // Cambiar selección por índice
  setLanguageByIndex(index) {
    const switcher = document.getElementById("language-switcher");
    if (switcher) {
      switcher.selectedIndex = index;
      const lang = switcher.options[index].value;
      this.changeLang(lang);
    }
  },

  // Inicializar el selector de idioma
  initLanguageSwitcher() {
    const switcher = document.getElementById("language-switcher");
    if (switcher) {
      // Obtener el idioma guardado (cookie o localStorage)
      const cookieLang = this.getLanguageCookie();
      const storageLang = this.getLanguageFromStorage();
      const savedLang = cookieLang || storageLang || "es";

      // Establecer el valor inicial basado en el idioma guardado
      const currentIndex = this.getLanguageIndex(savedLang);
      switcher.selectedIndex = currentIndex;

      // Actualizar el idioma actual
      this.currentLang = savedLang;

      switcher.addEventListener("change", (e) => {
        this.changeLang(e.target.value);
      });
    }
  },

  // Cambiar el idioma
  async changeLang(lang) {
    this.currentLang = lang;

    // Guardar en cookie y localStorage
    this.setLanguageCookie(lang);
    this.saveLanguageToStorage(lang);

    // Actualizar el selector visualmente
    const switcher = document.getElementById("language-switcher");
    if (switcher) {
      const index = this.getLanguageIndex(lang);
      switcher.selectedIndex = index;
      console.log("Idioma cambiado a:", lang, "Índice seleccionado:", index);
    }

    await this.loadTranslations(lang);
    this.translatePage();
  },

  // Traducir la página
  translatePage() {
    // Traducir elementos con atributo data-i18n
    document.querySelectorAll("[data-i18n]").forEach((element) => {
      const key = element.getAttribute("data-i18n");
      element.textContent = this.t(key);
    });

    // Traducir placeholders
    document.querySelectorAll("[data-i18n-placeholder]").forEach((element) => {
      const key = element.getAttribute("data-i18n-placeholder");
      element.placeholder = this.t(key);
    });

    // Traducir títulos
    document.querySelectorAll("[data-i18n-title]").forEach((element) => {
      const key = element.getAttribute("data-i18n-title");
      element.title = this.t(key);
    });

    // Traducir contenido HTML
    document.querySelectorAll("[data-i18n-html]").forEach((element) => {
      const key = element.getAttribute("data-i18n-html");
      element.innerHTML = this.t(key);
    });

    // Traducir mensajes de validación dinámicos
    document.querySelectorAll("span[data-msg-key]").forEach((span) => {
      const key = span.getAttribute("data-msg-key");
      if (key) {
        span.textContent = this.t(key);
      }
    });
  },
};

// Inicializar cuando el DOM esté listo
/* document.addEventListener("DOMContentLoaded", () => { */
/*   i18n.init(); */
/* }); */
