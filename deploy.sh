#!/bin/bash

# Laravel Render Deployment Setup Guide
# =====================================

## 1. GENERATE APP KEY
php artisan key:generate --force

## 2. CLEAR CACHES
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

## 3. OPTIMIZE FOR PRODUCTION
php artisan config:cache
php artisan route:cache

## 4. RUN MIGRATIONS
php artisan migrate --force

## 5. SEED DATABASE (optional)
# php artisan db:seed

echo "✓ Laravel deployment setup complete!"
