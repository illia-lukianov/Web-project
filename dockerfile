FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

# Встановлюємо залежності
RUN composer install --no-dev --optimize-autoloader

# ВАЖЛИВО: Надаємо права на запис для Laravel
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache && \
    chmod -R 775 /app/storage /app/bootstrap/cache

# Використовуємо змінну $PORT, яку надає Render
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-10000}