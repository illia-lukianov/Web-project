# SQLite to PostgreSQL Migration Guide

This guide will help you migrate your Laravel application from SQLite to PostgreSQL using Docker.

## What's Been Set Up

1. **Docker Compose Configuration** (`docker-compose.yml`)
   - PostgreSQL 16 Alpine image (free, lightweight)
   - Laravel app container with proper environment variables
   - Automatic database initialization

2. **Updated Dockerfile**
   - Added `pdo_pgsql` extension for PostgreSQL support
   - Added `libpq-dev` library for PostgreSQL development

3. **Migration Command**
   - Custom command: `php artisan migrate:sqlite-to-postgres`
   - Migrates all data from SQLite to PostgreSQL
   - Handles sequences and foreign keys properly

4. **Environment Configuration**
   - `.env` updated to use PostgreSQL credentials
   - Docker environment overrides with service names

## Migration Steps

### Step 1: Build and Start Docker Containers

```bash
cd /Users/lukanovillia/University/Web\ tech/Web-project

# Build and start containers
docker-compose build --no-cache
docker-compose up -d
```

This will:

- Pull PostgreSQL 16 Alpine image
- Build Laravel app image with PostgreSQL support
- Start both services
- Wait for PostgreSQL to be ready
- Run migrations automatically
- Start the Laravel app on http://localhost:8000

### Step 2: Verify PostgreSQL is Running

```bash
# Check container status
docker-compose ps

# You should see both containers running:
# - laravel_postgres (healthy)
# - laravel_app      (running)
```

### Step 3: Run Migrations

```bash
# Run migrations (should happen automatically, but you can run again if needed)
docker-compose exec app php artisan migrate --force
```

### Step 4: Migrate Data from SQLite to PostgreSQL

```bash
# Run the migration command
docker-compose exec app php artisan migrate:sqlite-to-postgres

# This will:
# 1. Connect to SQLite database
# 2. Connect to PostgreSQL database
# 3. Truncate PostgreSQL tables (avoiding constraint violations)
# 4. Copy all data from SQLite tables to PostgreSQL
# 5. Reset sequences for proper auto-increment
# 6. Show progress for each table
```

The command output will look something like:

```
Starting migration from SQLite to PostgreSQL...
✓ Connected to SQLite
✓ Connected to PostgreSQL

✓ Migrated 2 records from users
✓ Migrated 4 records from categories
✓ Migrated 15 records from posts
... and so on
```

### Step 5: Verify Data

```bash
# Check that data was migrated
docker-compose exec app php artisan tinker

# In Tinker, run:
>>> App\Models\User::count()
=> 2
>>> App\Models\Post::count()
=> 15
```

### Step 6: Access Your Application

Open your browser and navigate to: http://localhost:8000

## Troubleshooting

### PostgreSQL won't start

```bash
# Check logs
docker-compose logs postgres

# Ensure port 5432 is not in use
lsof -i :5432

# Try restarting
docker-compose restart postgres
```

### Connection refused error

```bash
# Make sure PostgreSQL is healthy
docker-compose exec postgres pg_isready

# Wait a bit longer for PostgreSQL to start
sleep 5
docker-compose exec app php artisan migrate
```

### Data migration failed

```bash
# Check app logs
docker-compose logs app

# Retry the migration
docker-compose exec app php artisan migrate:sqlite-to-postgres --force
```

### Foreign key constraint errors

These are usually handled automatically by the migration command. If you see them:

```bash
# The command uses CASCADE on truncate to handle dependencies
# Try again with more verbose output
docker-compose exec app php artisan migrate:sqlite-to-postgres -vvv
```

## Local Development (without Docker)

If you want to test locally before using Docker:

1. Install PostgreSQL locally (macOS):

```bash
brew install postgresql@16
brew services start postgresql@16
```

2. Create a database:

```bash
createdb -U postgres laravel_db
```

3. Update .env for local development:

```env
DB_CONNECTION=pgsql
DB_HOST=localhost
DB_PORT=5432
DB_DATABASE=laravel_db
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

4. Run migrations and migrate data:

```bash
php artisan migrate --force
php artisan migrate:sqlite-to-postgres --force
```

## Stopping and Cleaning Up

```bash
# Stop containers (data persists)
docker-compose down

# Stop and remove volumes (data is deleted!)
docker-compose down -v

# View PostgreSQL data volume
docker volume ls | grep postgres_data
```

## Using PostgreSQL Admin Tools

You can connect to your PostgreSQL database using:

- **pgAdmin** (Docker):

  ```bash
  docker run -p 5050:80 -e PGADMIN_DEFAULT_EMAIL=admin@example.com \
    -e PGADMIN_DEFAULT_PASSWORD=admin dpage/pgadmin4
  ```

  Then visit http://localhost:5050

- **DBeaver** (Desktop app):
  - Host: localhost
  - Port: 5432
  - Database: laravel_db
  - Username: laravel
  - Password: laravel_password

- **Table Plus** (Desktop app):
  - Same connection details as above

## Backing Up Your Data

```bash
# Backup PostgreSQL database
docker-compose exec postgres pg_dump -U laravel laravel_db > backup.sql

# Restore PostgreSQL database
docker-compose exec -T postgres psql -U laravel laravel_db < backup.sql
```

## Next Steps

1. **Test thoroughly**: Check all features work with PostgreSQL
2. **Update production**: Follow the same steps on your production server
3. **Monitor performance**: PostgreSQL might have different performance characteristics
4. **Cleanup**: You can delete the SQLite database once you're confident everything works

## Database Free Tier Options for Production

- **Render.com**: Free tier PostgreSQL (limited)
- **Railway.app**: Pay-as-you-go from $0
- **Supabase**: Free tier PostgreSQL up to 500MB
- **AWS RDS**: Free tier for 12 months
- **Google Cloud SQL**: Free tier available

All support PostgreSQL with Laravel!

## Need Help?

If you encounter any issues:

1. Check the logs: `docker-compose logs app` or `docker-compose logs postgres`
2. Verify containers are running: `docker-compose ps`
3. Try rebuilding: `docker-compose build --no-cache`
4. Check that ports 8000 and 5432 are available
