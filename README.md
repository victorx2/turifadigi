# TuRifadigi - Sistema de Lotería

## Descripción

Sistema integral para la gestión de loterías digitales que incluye:

- Gestión de sorteos y rifas
- Venta de boletos en línea
- Validación de ganadores
- Reportes y estadísticas
- Gestión de usuarios y roles
- Panel administrativo

## Estructura del Proyecto

```
/TuRifadigi/
├── assets/         # Recursos estáticos (CSS, JS, imágenes)
├── src/            # Código fuente principal
├── vendor/         # Dependencias de PHP (Composer)
├── node_modules/   # Dependencias de JavaScript (npm)
├── views/          # Vistas de la aplicación
├── index.php       # Punto de entrada de la aplicación
└── .htaccess      # Configuración del servidor Apache
```

## Archivos de Configuración

- `composer.json` - Gestión de dependencias PHP
- `composer.lock` - Versiones exactas de dependencias PHP
- `package.json` - Gestión de dependencias JavaScript
- `package-lock.json` - Versiones exactas de dependencias JavaScript
- `.gitignore` - Archivos y directorios ignorados por Git
- `.htaccess` - Configuración de Apache

## Requisitos del Sistema

### Backend

- PHP >= 7.4
- MySQL >= 8.0
- Apache/Nginx
- Composer

### Frontend

- Node.js >= 14.x
- npm >= 6.x

## Instalación

1. Clonar el repositorio:

   ```bash
   git clone https://github.com/tuusuario/TuRifadigi.git
   cd TuRifadigi
   ```

2. Instalar dependencias PHP:

   ```bash
   composer install
   ```

3. Instalar dependencias JavaScript:

   ```bash
   npm install
   ```

4. Configurar el archivo `.env`:

   ```bash
   cp .env.example .env
   # Editar .env con tus configuraciones
   ```

5. Configurar la base de datos:

   - Crear una base de datos MySQL
   - Actualizar las credenciales en el archivo `.env`

6. Iniciar el servidor de desarrollo:
   ```bash
   php -S localhost:8000
   ```

## Características Principales

- Sistema de autenticación y autorización
- Gestión de sorteos y rifas
- Proceso de venta de boletos
- Validación automática de ganadores
- Generación de reportes en PDF
- Panel administrativo completo
- API RESTful para integraciones

## Seguridad

- Autenticación mediante JWT
- Validación de datos en frontend y backend
- Protección contra CSRF
- Encriptación de datos sensibles
- Control de acceso basado en roles

## Contribución

1. Fork el proyecto
2. Crear una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abrir un Pull Request

## Licencia

Este proyecto está bajo la Licencia MIT - ver el archivo `LICENSE` para más detalles.

## Soporte

Para soporte, por favor crear un issue en el repositorio o contactar al equipo de desarrollo.
