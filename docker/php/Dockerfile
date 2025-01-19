FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    unzip \
    libpq-dev \
    libzip-dev \
    default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html