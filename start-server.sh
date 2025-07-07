#!/bin/bash

echo "🚀 Iniciando start-server.sh..."

# Verificar si .env existe
if [ ! -f .env ]; then
  echo ".env no encontrado. Abortando."
  exit 1
fi

# Limpiar y cachear configuración
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Crear enlace simbólico para storage si es necesario
php artisan storage:link || true

# Asignar permisos correctos
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data .

# Ejecutar migraciones forzadas
php artisan migrate --force

echo "✅ Laravel preparado. Iniciando Apache..."

# Iniciar Apache en primer plano
apache2-foreground
