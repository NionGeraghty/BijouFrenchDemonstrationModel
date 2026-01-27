FROM php:8.3-fpm

# System deps
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    libzip-dev \
    zip \
    curl \
    npm \
    nodejs \
    && docker-php-ext-install intl zip opcache pdo pdo_mysql

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy files
COPY . .

# Create Laravel cache directories
RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

# Install PHP deps
RUN composer install --no-dev --optimize-autoloader

# Build frontend
RUN npm install && npm run build

# Expose port
EXPOSE 8080

CMD php artisan serve --host=0.0.0.0 --port=8080
