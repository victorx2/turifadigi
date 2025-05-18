// assets/js/i18n.js

let translations = {};

function getCurrentLang() {
  return (
    document.cookie
      .split("; ")
      .find((row) => row.startsWith("language="))
      ?.split("=")[1] || "es"
  );
}

async function loadTranslations(lang) {
  const response = await fetch(`assets/language/${lang}.json`);
  translations = await response.json();
}

function t(key) {
  return translations[key] || key;
}

async function translateSignupForm() {
  // Esperar a que se carguen las traducciones
  await loadTranslations(getCurrentLang());

  // Títulos y botones
  const title = document.querySelector(".section-title__title");
  if (title) title.textContent = t("register_account");
  const btn = document.getElementById("buttonForm");
  if (btn) btn.textContent = t("register");

  // Labels e inputs
  const map = [
    { label: 'label[for="nombre_signup"]', key: "first_name" },
    { label: 'label[for="apellido_signup"]', key: "last_name" },
    { label: 'label[for="cedula_signup"]', key: "id" },
    { label: 'label[for="ubicacion_signup"]', key: "location" },
    { label: 'label[for="usuario_signup"]', key: "username" },
    { label: 'label[for="password_signup"]', key: "password" },
    { label: 'label[for="telefono_signup"]', key: "phone" },
    { label: 'label[for="correo_signup"]', key: "email" },
  ];
  map.forEach(({ label, key }) => {
    const el = document.querySelector(label);
    if (el) {
      // Mantener el icono
      const icon = el.querySelector("i");
      el.innerHTML = (icon ? icon.outerHTML + " " : "") + t(key) + " *";
    }
  });

  // Placeholders
  const placeholders = [
    { input: "#nombre_signup", key: "enter_first_name" },
    { input: "#apellido_signup", key: "enter_last_name" },
    { input: "#cedula_signup", key: "enter_id" },
    { input: "#ubicacion_signup", key: "enter_location" },
    { input: "#usuario_signup", key: "enter_username" },
    { input: "#password_signup", key: "enter_password" },
    { input: "#telefono_signup", key: "enter_phone" },
    { input: "#correo_signup", key: "enter_email" },
  ];
  placeholders.forEach(({ input, key }) => {
    const el = document.querySelector(input);
    if (el) el.placeholder = t(key);
  });

  // Texto de abajo
  const already = document.querySelector(".contact-two__left-text");
  if (already) {
    already.innerHTML = `${t("already_have_account")} <a href="/login">${t(
      "login"
    )}</a>`;
  }
}

function setLanguageCookie(lang) {
  document.cookie = `language=${lang}; path=/; max-age=${30 * 24 * 60 * 60}`;
}

function changeLanguage(lang) {
  setLanguageCookie(lang);
  // Si estamos en signup, traducir dinámicamente
  if (window.location.pathname.includes("/signup")) {
    translateSignupForm();
  } else {
    location.reload();
  }
}

function initLanguageSwitcher() {
  const currentLang = getCurrentLang();
  const switcher = document.getElementById("language-switcher");
  if (switcher) {
    switcher.value = currentLang;
    switcher.addEventListener("change", (e) => {
      changeLanguage(e.target.value);
    });
  }
}

document.addEventListener("DOMContentLoaded", () => {
  initLanguageSwitcher();
  // Traducir siempre el signup si existe
  if (window.location.pathname.includes("/signup")) {
    translateSignupForm();
  }
});
