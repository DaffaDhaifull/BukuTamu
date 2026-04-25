FROM dunglas/frankenphp:php8.2-alpine

# Install PHP extensions required for Laravel & PostgreSQL
RUN install-php-extensions \
    pdo_pgsql \
    pdo_mysql \
    pcntl \
    gd \
    zip \
    redis

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy semua file project
COPY . .

# Install dependencies PHP via Composer
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_HTTP_TIMEOUT=600
ENV COMPOSER_PROCESS_TIMEOUT=2000

# Bypass masalah IPv6/Timeout pada Docker Packagist
RUN composer config --global repo.packagist composer https://packagist.org

RUN composer install --no-dev --optimize-autoloader

# Install Laravel Octane & konfigurasi server untuk FrankenPHP
RUN composer require laravel/octane --no-interaction \
    && php artisan octane:install --server=frankenphp --no-interaction

# Expose port 8000
EXPOSE 8000

# Jalankan server menggunakan Octane Worker Mode (FrankenPHP)
CMD ["php", "artisan", "octane:start", "--server=frankenphp", "--host=0.0.0.0", "--port=8000"]
