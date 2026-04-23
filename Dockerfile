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

# Set working directory
WORKDIR /var/www

# Copy semua file ke dalam container (termasuk vendor dan .env)
COPY . .

# Expose port 8000 untuk artisan serve
EXPOSE 8080

# Jalankan server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
