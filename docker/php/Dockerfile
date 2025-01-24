FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    unzip \
    libpq-dev \
    libzip-dev \
    default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY backend /var/www/html

# Check if composer.json exists
RUN test -f /var/www/html/composer.json

# Set environment variable to allow Composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER=1

# Run composer install
RUN composer install

WORKDIR /var/www/html

# Ensure proper permissions and environment setup
RUN chown -R www-data:www-data /var/www/html