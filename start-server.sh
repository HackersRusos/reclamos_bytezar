#!/bin/bash

# Cachear configuración y rutas
php artisan config:cache
php artisan route:cache

# Ejecutar migraciones pendientes sin perder datos
php artisan migrate --force

# Iniciar Apache
apache2-foreground
