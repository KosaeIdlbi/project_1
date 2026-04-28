#!/bin/bash

# --- 1. إصلاح الصلاحيات ---
echo "Fixing storage permissions..."
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/bootstrap/cache
chmod -R 777 /var/www/html/storage
chmod -R 777 /var/www/html/bootstrap/cache

# --- 2. الانتظار لقاعدة البيانات ---
echo "Waiting for database connection..."
until php -r "try { new PDO('pgsql:host=${DB_HOST};dbname=${DB_DATABASE}', '${DB_USERNAME}', '${DB_PASSWORD}'); echo 'OK'; } catch (Exception \$e) { echo 'WAIT'; exit(1); }" | grep OK > /dev/null; do
    echo "Database is unavailable - sleeping"
    sleep 3
done
echo "Database connected!"

# --- 3. إعداد Laravel ---
echo "Running migrations..."
php artisan migrate:fresh --force
php artisan migrate --force

echo "Running seeders..."
php artisan db:seed --force -v || true

echo "Linking storage..."
php artisan storage:link

echo "Optimizing..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# --- 4. بدء الخدمات ---
npm run dev

echo "Starting Laravel Development Server..."
php artisan serve --host=0.0.0.0 --port=8000 &

echo "Starting Reverb Server..."
php artisan reverb:start --debug &

echo "Starting Queue Worker..."
php artisan queue:work --tries=3 --sleep=3 --timeout=60 &

# --- 6. الانتظار ---
echo "All services started. Keeping container alive..."
wait