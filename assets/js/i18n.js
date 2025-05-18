// Sistema de traducciones
const i18n = {
  // Almacena las traducciones
  translations: {},

  // Idioma actual
  currentLang: "es",

  // Inicializar el sistema
  async init() {
    console.log("Inicializando sistema de traducciones...");
    // Verificar si existen los archivos JSON de traducción
    try {
      const esResponse = await fetch("assets/language/es.json");
      const enResponse = await fetch("assets/language/en.json");

      if (!esResponse.ok || !enResponse.ok) {
        throw new Error("No se encontraron los archivos de traducción");
      }

      console.log("Archivos de traducción encontrados: es.json y en.json");

      // SIEMPRE usa español por defecto al cargar
      this.currentLang = "es";
      console.log(`Idioma actual: ${this.currentLang}`);

      // Cargar las traducciones
      await this.loadTranslations(this.currentLang);

      // Inicializar el selector de idioma
      this.initLanguageSwitcher();

      // Traducir la página
      this.translatePage();
      console.log("Sistema de traducciones inicializado correctamente");
    } catch (error) {
      console.error("Error verificando archivos de traducción:", error);
      alert(
        "No se encontraron los archivos de traducción. Por favor, verifica que existan es.json y en.json en la carpeta assets/language/"
      );
    }
  },

  // Cargar traducciones desde el archivo JSON
  async loadTranslations(lang) {
    console.log(`Cargando traducciones para el idioma: ${lang}`);
    try {
      const response = await fetch(`assets/language/${lang}.json`);
      if (!response.ok) {
        throw new Error(`No se encontró el archivo ${lang}.json`);
      }
      this.translations = await response.json();
      console.log("Traducciones cargadas:", this.translations);
    } catch (error) {
      console.error("Error cargando traducciones:", error);
      alert(
        `Error cargando traducciones para ${lang}. Verifica que el archivo ${lang}.json exista y tenga el formato correcto.`
      );
    }
  },

  // Obtener una traducción
  t(key) {
    const translation = this.translations[key] || key;
    console.log(`Traduciendo clave: ${key} -> ${translation}`);
    return translation;
  },

  // Cambiar el idioma
  async changeLang(lang) {
    console.log(`Cambiando idioma a: ${lang}`);
    this.currentLang = lang;
    document.cookie = `language=${lang}; path=/; max-age=${30 * 24 * 60 * 60}`;
    await this.loadTranslations(lang);
    this.translatePage();
    console.log(`Idioma cambiado exitosamente a: ${lang}`);
  },

  // Inicializar el selector de idioma
  initLanguageSwitcher() {
    console.log("Inicializando selector de idioma...");
    const switcher = document.getElementById("language-switcher");
    if (switcher) {
      switcher.value = this.currentLang;
      switcher.addEventListener("change", (e) => {
        console.log("Selección de idioma cambiada:", e.target.value);
        this.changeLang(e.target.value);
      });
      console.log("Selector de idioma inicializado correctamente");
    } else {
      console.log("No se encontró el selector de idioma");
    }
  },

  // Traducir la página
  translatePage() {
    console.log("Iniciando traducción de la página...");
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

    console.log("Página traducida correctamente");
  },
};

// Inicializar cuando el DOM esté listo
document.addEventListener("DOMContentLoaded", () => {
  console.log("DOM cargado, inicializando traducciones...");
  i18n.init();
});
