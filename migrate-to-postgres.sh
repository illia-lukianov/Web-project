#!/bin/bash

# Script to prepare SQLite database and migrate to PostgreSQL

set -e

PROJECT_DIR="$(cd "$(dirname "$0")" && pwd)"
cd "$PROJECT_DIR"

echo "=========================================="
echo "SQLite to PostgreSQL Migration Helper"
echo "=========================================="
echo ""

# Check if we're in Docker or local environment
if [ -f "/.dockerenv" ]; then
    echo "Running in Docker environment..."
    DOCKER_MODE=true
else
    echo "Running in local environment..."
    DOCKER_MODE=false
fi

echo ""
echo "Step 1: Ensuring SQLite database has all migrations..."
if [ "$DOCKER_MODE" = true ]; then
    # In Docker, temporarily switch to SQLite to run migrations
    DB_CONNECTION_BACKUP=$DB_CONNECTION
    export DB_CONNECTION=sqlite
    php artisan migrate --force
    export DB_CONNECTION=$DB_CONNECTION_BACKUP
else
    # Local development - use SQLite for migrations
    php artisan migrate --force --using=sqlite
fi

echo "✓ SQLite migrations complete"
echo ""

echo "Step 2: Migrating data to PostgreSQL..."
php artisan migrate:sqlite-to-postgres --force

echo ""
echo "=========================================="
echo "✓ Migration complete!"
echo "=========================================="
