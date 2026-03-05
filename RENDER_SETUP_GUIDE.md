# 🚀 КРОК ЗА КРОКОМ: Розгортання на Render

## ЧЕКЛІСТ НАЛАШТУВАННЯ

### ✅ ЛОКАЛЬНО (перед push на GitHub)

```bash
# 1. Переконайтеся що все працює локально
docker-compose down
docker-compose build --no-cache
docker-compose up

# 2. Перевірте http://localhost:8000
# Повинна бути видима домашня сторінка

# 3. Commit та Push змін
git add .
git commit -m "Fix Render deployment configuration"
git push origin main
```

### ✅ НА RENDER.COM

#### **КРОК 1: Створіть новий Web Service**

1. Зайдіть на https://dashboard.render.com
2. Натисніть **"New +"** → **"Web Service"**
3. Виберіть **"Deploy an existing GitHub repository"**
4. Виберіть ваш репозиторій
5. Натисніть **"Connect"**

#### **КРОК 2: Конфігурація Service**

```
Name:               laravel-app
Environment:        Docker
Build Command:      (залиште пусте - користуватиметься Dockerfile)
Start Command:      (залиште пусте - користуватиметься Dockerfile)
Region:             Singapore (обрати найближчий до ваших користувачів)
Plan:               FREE (відповідно до свободного тарифу)
```

⚠️ **ВАЖЛИВО ДЛЯ FREE TIER:**

- ✅ БД: SQLite (зберігається в контейнері)
- ✅ Без зовнішнього PostgreSQL
- ✅ Один web service без додатків

#### **КРОК 3: Environment Variables**

На сторінці Web Service натисніть **"Environment"** та додайте:

```
APP_NAME                    Laravel
APP_ENV                     production
APP_DEBUG                   false
APP_URL                     https://ВАМИ-APP-NAME.onrender.com  # __important__: include https scheme (otherwise css/js links will use http and be blocked as mixed content)
APP_KEY                     base64:YOUR_APP_KEY_HERE
PORT                        8000

DB_CONNECTION               sqlite
SESSION_DRIVER              database
QUEUE_CONNECTION            database
CACHE_STORE                 database
LOG_CHANNEL                 stderr
```

**ДЖерело для APP_KEY:**

Запустіть локально:

```bash
php artisan key:generate
# Скопіюйте значення APP_KEY= з .env
```

---

## 📌 ОБМЕЖЕННЯ FREE TIER

| Обмеження         | Деталь                                                                            |
| ----------------- | --------------------------------------------------------------------------------- |
| 💾 БД             | SQLite (у контейнері, на диску Render)                                            |
| ⏱️ Холодний старт | Контейнер спить після 15 хвилин неактивності                                      |
| 🔄 Стан БД        | SQLite база персиситується на **Render's disk** (не видаляється при перезагрузці) |
| 📊 Ресурси        | Спільне CPU, ~512MB RAM                                                           |
| 🚀 Performance    | Медленніше ніж Pro план                                                           |

### Для Production рекомендуємо:

- 🔵 Перейти на **Pro план** (~$12/місяць)
- ✅ Отримаєте PostgreSQL базу
- ✅ Сайт завжди активний (без sleep)
- ✅ Більше ресурсів

#### **КРОК 4: Deploy**

1. Натисніть **"Deploy"** і чекайте 5-10 хвилин
2. Перевіріть **"Events"** та **"Logs"** під час build

#### **КРОК 5: Перевірка**

```bash
# Перевірте чи сайт відповідає
curl https://your-app-name.onrender.com

# Перевірте логи
# Render Dashboard → Logs → дивіться в реальному часі
```

---

### ⚙️ НАЛАШТУВАННЯ АДМІНА (Free plan)

Через відсутність shell на free плані, просто скористайтеся seeder:

1. Додайте змінні оточення на Render:
   ```
   ADMIN_EMAIL=you@domain.com
   ADMIN_PASSWORD=someStrongPass   # необов'язково, дефолт 'password'
   ```
2. Заново задеплойте сервіс — `DatabaseSeeder` автоматично створить користувача
   з роллю `admin` під цим email.
3. Ввійдіть за цими даними і ви матимете права адміністратора.

> \*Змінні можна встановити один раз; seeder використовує `firstOrNew`.

## 🐛 ЯКЩО ВИНИКЛА ПОМИЛКА

### Помилка: "500 Internal Server Error"

> 🔐 **HTTPS / mixed content issue**
>
> Якщо CSS/JS не завантажуються, перевірте чи у вас `APP_URL` вказаний з **https://**.
> Під час генерації asset() посилань Laravel бере схему з `APP_URL` — якщо там `http://`
> то браузер заблокує ресурси на сторінці, яка працює по HTTPS.
>
> **Додатково** можна примусово форсувати схему у `App\Providers\AppServiceProvider`:
>
> ```php
> use Illuminate\Support\Facades\URL;
>
> public function boot()
> {
>     if(config('app.env') === 'production') {
>         URL::forceScheme('https');
>     }
> }
> ```

**Перевірьте логи:**

- Зайдіть в Render Dashboard
- Натисніть на ваш Web Service
- Відкрийте вкладку **"Logs"**
- Порівняйте з цим списком:

| Помилка                     | Причина              | Виправлення                         |
| --------------------------- | -------------------- | ----------------------------------- |
| `MissingAppKeyException`    | Немає APP_KEY        | Додайте APP_KEY в ENV vars          |
| `database.sqlite not found` | БД файл не створений | Переконайтеся що directory writable |
| `File not found: views/`    | Cache не створений   | Restart service                     |
| `SQLSTATE[HY000]`           | Помилка БД           | Перевірте DB_CONNECTION=sqlite      |

### Помилка: "Build failed"

Перевірте в **Build Logs**. Типово:

- ❌ Composer error → перевірте `composer.json`
- ❌ Docker error → перевірте `dockerfile`

Виправте локально та push:

```bash
git add .
git commit -m "Fix build errors"
git push
```

---

## 📞 КОНТАКТИ RENDER SUPPORT

Якщо все ще не працює:

- https://render.com/docs
- https://render.com/support

---

## 💡 КОРИСНІ КОМАНДИ

```bash
# Перезавантажити service
# На Render Dashboard → Manual Deploy

# Подивитися логи локально
docker-compose logs -f app

# Перезагрузити контейнер
docker-compose restart app

# Видалити все та почати з нуля
docker-compose down -v
docker system prune -a
```

---

## ✨ ГОТОВО!

Після успішного розгортання:

- ✅ Сайт доступний на https://your-app-name.onrender.com
- ✅ БД активна та мігрована
- ✅ Логи видні в реальному часі
- ✅ Auto-restart при crash
- ✅ SSL сертифікат автоматичний

Успіхів! 🚀
