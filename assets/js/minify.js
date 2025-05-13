const fs = require("fs");
const path = require("path");
const postcss = require("postcss");
const cssnano = require("cssnano");
const { minify } = require("terser");

// Configuración de archivos a minificar
const cssFiles = [
  { input: "assets/css/custom.css", output: "assets/css/custom.min.css" },
  {
    input: "assets/css/custom_responsive.css",
    output: "assets/css/custom_responsive.min.css",
  },
  // Agrega más archivos CSS aquí en el mismo formato
];

const jsFiles = [
  { input: "assets/js/main.js", output: "assets/js/main.min.js" },
  { input: "assets/js/header.js", output: "assets/js/header.min.js" },
  // Agrega más archivos JS aquí en el mismo formato
];

// Función para minificar CSS
async function minifyCSS(inputPath, outputPath) {
  const css = fs.readFileSync(inputPath, "utf8");
  const result = await postcss([cssnano]).process(css, { from: inputPath });
  fs.writeFileSync(outputPath, result.css);
  console.log(`CSS minificado: ${outputPath}`);
}

// Función para minificar JS
async function minifyJS(inputPath, outputPath) {
  const js = fs.readFileSync(inputPath, "utf8");
  const result = await minify(js);
  fs.writeFileSync(outputPath, result.code);
  console.log(`JS minificado: ${outputPath}`);
}

// Ejecutar minificación
async function run() {
  try {
    // Minificar archivos CSS
    for (const file of cssFiles) {
      if (fs.existsSync(file.input)) {
        await minifyCSS(file.input, file.output);
      } else {
        console.warn(`Archivo no encontrado: ${file.input}`);
      }
    }

    // Minificar archivos JS
    for (const file of jsFiles) {
      if (fs.existsSync(file.input)) {
        await minifyJS(file.input, file.output);
      } else {
        console.warn(`Archivo no encontrado: ${file.input}`);
      }
    }
  } catch (error) {
    console.error("Error durante la minificación:", error);
  }
}

run();
