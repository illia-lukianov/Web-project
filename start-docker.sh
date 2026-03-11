#!/bin/bash

# Script to build and start Docker containers with PostgreSQL

echo "Building Docker image..."
docker-compose build --no-cache

echo "Starting Docker containers..."
docker-compose up -d

echo "Waiting for PostgreSQL to be ready..."
sleep 10

echo "Running migrations..."
docker-compose exec -T app php artisan migrate --force

echo "Setup complete! The application is running at http://localhost:8000"
echo ""
echo "To migrate data from SQLite to PostgreSQL, run:"
echo "docker-compose exec app php artisan migrate:sqlite-to-postgres"
