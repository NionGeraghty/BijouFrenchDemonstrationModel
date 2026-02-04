FROM php:8.3-cli

# System deps
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    libzip-dev \
    zip \
    curl \
    nodejs \
    npm \
    && docker-php-ext-install intl zip pdo pdo_mysql opcache

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy files
COPY . .

# Laravel directories + permissions
RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

# Install PHP deps
RUN composer install --no-dev --optimize-autoloader

# Build frontend
RUN rm -rf node_modules public/build \
 && npm install \
 && npm run build

# Expose Railway port
EXPOSE 8080

# Production-safe entry
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
