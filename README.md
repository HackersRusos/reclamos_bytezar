# Reclamos BYTEZAR

Sistema de gestión de reclamos desarrollado con Laravel y Livewire.

## 🚀 Descripción del Proyecto

Reclamos BYTEZAR es una aplicación web que permite a los usuarios crear, visualizar y hacer seguimiento de reclamos, y a los administradores gestionarlos de manera eficiente. El sistema fue desarrollado con Laravel + Livewire y desplegado usando **Render**.

## 🎯 Funcionalidades

- Autenticación de usuarios con Laravel Breeze
- Formulario de reclamos dinámico con categorías y tipos cargados automáticamente
- Validaciones en tiempo real con Livewire
- Filtrado de reclamos por estado, tipo y categoría
- Dashboard personalizado para administradores y usuarios
- Notificaciones automáticas para nuevos reclamos
- Control de roles y acceso
- Migraciones automáticas y caché de configuración en producción
- Despliegue en Render usando Docker

## ⚙️ Tecnologías utilizadas

- PHP 8.2
- Laravel 10.x
- Livewire 3 (con Volt)
- PostgreSQL
- Docker + Apache
- Render (hosting)
- GitHub + Railway (pruebas de despliegue)
- Breeze (auth)
- Tailwind CSS

## 🚢 Despliegue

La aplicación fue desplegada en [Render.com](https://reclamos-bytezar.onrender.com/) con el siguiente stack:

- `Dockerfile` que instala dependencias, configura Apache y ejecuta los comandos de build y migración
- `render.yaml` que configura el servicio web y define comandos de inicio
- Script `start-server.sh` para cachear config/rutas, migrar y levantar el servidor

## 📁 Estructura clave

- `app/Livewire/Reclamos` → Componentes Livewire para crear y listar reclamos
- `resources/views` → Plantillas Blade
- `public/` → Archivos estáticos y favicon
- `.env` → Variables de entorno (manejadas desde el dashboard de Render)

## 🛠️ Consideraciones importantes

- En producción, `APP_ENV=production` y `SESSION_SECURE_COOKIE=true` para manejo correcto de cookies
- `APP_URL` y `ASSET_URL` deben coincidir con la URL de Render para evitar errores con assets y sesiones
- El `.env` no se sube al repositorio. Las variables se cargan manualmente en Render (en la sección de Environment Variables)

## 🧑‍💻 Autores

Proyecto desarrollado por un grupo de 6 estudiantes de la carrera **Tecnicatura Universitaria en Programación** de la **Universidad Tecnológica Nacional - Facultad Regional Resistencia, Sede Extensión Áulica Formosa**, como parte de la materia **Programación III**, y aplicado al emprendimiento **BYTEZAR**.

### Integrantes del grupo:
- Javier Quintana
- Sofía Vera
- Gabriela Heretichi
- Leandro Nacimento
- Manuel Recalde
- Gustavo Gines
