# 🔴 Render Deployment Fix Guide

## Проблема

Локально контейнер працює, але на Render виникає **500 помилка без деталей**.

## ✅ Що я виправив

### 1. **Dockerfile оновлений**

- ✓ Видалю `libpq-dev` та `pdo_pgsql` (для free tier використовуємо SQLite)
- ✓ Додав `artisan config:cache` та `artisan route:cache` для оптимізації
- ✓ Помістив `artisan migrate --force` в CMD для автоматичного запуску міграцій
- ✓ Zmінено Port на 8000 (стандарт Render)

### 2. **Створив .env.example**

- Правильна конфігурація для production
- **SQLite** як стандартна база (для free tier)
- Всі необхідні змінні для Render

### 3. **Створив render.yaml**

- Автоматична конфігурація при розгортанні на Render
- **Без зовнішньої БД** (SQLite у контейнері)
- Правильні environment змінні для free tier

### 4. **Створив deploy.sh**

- Скрипт для ручного розгортання локально

---

## 📋 ОБОВ'ЯЗКОВІ КРОКИ НА RENDER

### На панелі Render:

1. **В Dashboard → Environment Variables додайте:**

   ```
   APP_NAME=Laravel
   APP_ENV=production
   APP_DEBUG=false
   APP_KEY=base64:<YOUR_APP_KEY>
   DB_CONNECTION=sqlite
   LOG_CHANNEL=stderr
   ```

2. **Щоб отримати APP_KEY локально, запустіть:**

   ```bash
   php artisan key:generate
   ```

   Скопіюйте значення з `.env` в Render

3. **Перенаправте логи на STDOUT (для debug на Render):**
   В `config/logging.php` змініть:
   ```php
   'stderr' => [
       'driver' => 'monolog',
       'handler' => StreamHandler::class,
       'with' => ['stream' => 'php://stderr'],
   ],
   ```

---

## 🚀 ЛОКАЛЬНЕ ТЕСТУВАННЯ

```bash
# Переконайтеся що все працює локально
docker-compose build
docker-compose up

# Перевірте доступ
curl http://localhost:8000
```

## 🔍 ОТРИМАННЯ ЛОГІВ НА RENDER

Коли розгорітеся на Render, йдіть в:

- **Dashboard → Logs**

Там ви побачите точну помилку замість generic 500.

---

## 🆘 ТИПОВІ ПРОБЛЕМИ

### 1. "Illuminate\Encryption\MissingAppKeyException"

- **Причина**: Немає APP_KEY в .env на Render
- **Виправлення**: Додайте APP_KEY в Environment Variables

### 2. "SQLSTATE[HY000]: General error: 1 unable to open database file"

- **Причина**: Директорія БД не має прав на запис (SQLite потребує записування файла)
- **Виправлення**: Dockerfile автоматично створює директорів, але переконайтеся що `/app/storage` writable

### 3. "database.sqlite not found"

- **Причина**: SQLite файл ще не створений
- **Виправлення**: Запустяться міграції автоматично, база буде створена

### 4. "view cache not found"

- **Причина**: view:cache не запущений
- **Виправлення**: Dockerfile це робить автоматично тепер

---

## 📝 АЛГОРИТМ РОЗГОРТАННЯ

1. **Загрузьте код на GitHub**

   ```bash
   git add .
   git commit -m "Fix Render deployment"
   git push
   ```

2. **На Render**: Connect Github repo → Auto-deploy з main branch

3. **Встановіть Environment Variables** в Render Dashboard

4. **Дождьтеся build** (3-5 хвилин)

5. **Перевірте логи** при помилках

---

## ✨ ДОДАТКОВО

Якщо хочете більш надійне рішення, розгляньте:

- Використання Nginx замість `php artisan serve` (краще для production)
- Cloud storage для uploaded files (AWS S3)
- Redis для session/cache (замість database)
