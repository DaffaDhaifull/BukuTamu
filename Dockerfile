FROM php:8.2-cli

# Install system dependencies & PHP extensions (termasuk PostgreSQL untuk Supabase)
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_pgsql pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy semua file ke dalam container
COPY . .

# Install dependencies PHP menggunakan composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --optimize-autoloader

# Expose port 8080 untuk artisan serve
EXPOSE 8080

# Jalankan server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
