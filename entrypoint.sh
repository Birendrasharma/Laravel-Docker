#!/bin/bash
set -e

echo "Installing Composer dependencies..."
composer install --no-interaction --prefer-dist

echo "Running Laravel migrations..."
php artisan migrate --force

echo "Starting PHP-FPM..."
exec php-fpm
