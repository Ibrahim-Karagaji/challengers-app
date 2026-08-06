#!/bin/sh
set -e

# Copy .env.example to .env if .env doesn't exist
if [ ! -f .env ]; then
    echo "Creating .env file..."
    cp .env.example .env
fi

# Install PHP dependencies if vendor folder missing
if [ ! -d vendor ]; then
    echo "Installing Composer dependencies..."
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

# Install JS dependencies & build assets if node_modules missing
if [ ! -d node_modules ]; then
    echo "Installing NPM dependencies..."
    npm install
fi

echo "Building frontend assets with Vite..."
npm run build

# Ensure database.sqlite exists for SQLite database driver
mkdir -p database
touch database/database.sqlite

# Generate app key if not set
if ! grep -q "APP_KEY=base64:" .env; then
    echo "Generating Application Key..."
    php artisan key:generate --force
fi

# Run database migrations
echo "Running Database Migrations..."
php artisan migrate --force

echo "Starting Laravel server..."
exec php artisan serve --host=0.0.0.0 --port=8000
