# Imagen base oficial de PHP con Apache
FROM php:8.2-apache

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    libonig-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Habilitar mod_rewrite de Apache (para Laravel)
RUN a2enmod rewrite

# Copiar archivos del proyecto a Apache
COPY . /var/www/html

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Asignar permisos a Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instalar dependencias de Laravel
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Exponer el puerto
EXPOSE 80
