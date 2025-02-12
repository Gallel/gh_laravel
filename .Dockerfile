FROM php:8.2-fpm

# Instal·la els paquets del sistema necessaris
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

# Instal·la extensions de PHP necessàries per Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instal·la Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Defineix el directori de treball
WORKDIR /var/www

# Copia el codi de l'aplicació
COPY . /var/www

# Canvia la propietat dels fitxers
RUN chown -R www-data:www-data /var/www

# Exposa el port 9000 per a php-fpm (ja no necessari si utilitzem artisan serve)
EXPOSE 9000

# Inicia el servidor de desenvolupament de Laravel
#CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=9000"]
CMD ["sh", "-c", "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=9000"]