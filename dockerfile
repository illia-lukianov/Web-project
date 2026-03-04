FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

# Встановлюємо залежності
RUN composer install --no-dev --optimize-autoloader

# Готуємо директорії
RUN mkdir -p /app/storage/logs && \
    chmod -R 775 /app/storage /app/bootstrap/cache

# Оптимізуємо конфіг та кеш
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Запускаємо міграції та стартуємо додаток
CMD php artisan migrate --force && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-8000}