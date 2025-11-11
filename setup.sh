#!/bin/bash

# Create .env from .env.example
cp .env.example .env

# Install composer
echo "INSTALL COMPOSER"
composer install
composer dump-autoload

# Install npm 
echo "INSTALL NPM"
npm install
# Cache config
php artisan config:cache

# Run command
php artisan run:setup_db laravel_v2