FROM php:8.4-cli

# Install system dependencies including PostgreSQL
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libzip-dev \
    libpq-dev \
    postgresql-client \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
    docker-php-ext-install -j$(nproc) zip pdo pdo_mysql pdo_pgsql

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
CMD sh -c "php artisan migrate --force --seed && \
    php artisan cache:clear && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"