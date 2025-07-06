# Imagen base de PHP con Apache
FROM php:8.2-apache

# --- Instalar dependencias del sistema ---
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip unzip git curl \
    libzip-dev libonig-dev \
    nodejs npm \
    && docker-php-ext-install pdo pdo_pgsql zip

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Cambiar DocumentRoot a /public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Copiar archivos del proyecto
COPY . /var/www/html

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

# Instalar dependencias PHP
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# --- COMPILAR ASSETS VITE ---
RUN npm install && npm run build

# Establecer permisos correctos
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html && \
    chmod -R 755 /var/www/html/storage && \
    chmod -R 755 /var/www/html/bootstrap/cache

# Puerto expuesto
EXPOSE 80
