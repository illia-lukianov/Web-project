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
    chmod -R 775 /app/storage /app/bootstrap/cache && \
    chmod -R 755 /app/public

# Запускаємо міграції та стартуємо додаток
CMD sh -c "php artisan migrate --force && \
    php artisan cache:clear && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"