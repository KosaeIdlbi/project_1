# --- 1. إصلاح الصلاحيات ---
echo "Fixing storage permissions..."
if [ -f /var/www/html/storage/logs/laravel.log ]; then
    chmod 777 /var/www/html/storage/logs/laravel.log
fi
chmod -R 777 /var/www/html/storage
chmod -R 777 /var/www/html/bootstrap/cache

# --- 2. انتظار قاعدة البيانات ---
echo "Waiting for database connection..."
until php -r "try { new PDO('pgsql:host=${DB_HOST};dbname=${DB_DATABASE}', '${DB_USERNAME}', '${DB_PASSWORD}'); echo 'OK'; } catch (Exception \$e) { echo 'WAIT'; exit(1); }" | grep OK > /dev/null; do
    echo "Database is unavailable - sleeping"
    sleep 3
done
echo "Database connected!"

# --- 3. تشغيل الميغريشنز ---
# php artisan migrate --force

# --- 4. تشغيل البذور ---
# php artisan db:seed --force

# --- 5. تشغيل الخدمات في الخلفية ---
php artisan queue:work --daemon &
php artisan reverb:start --debug &

# --- 6. تشغيل الخادم الرئيسي ---
# php artisan serve --host=0.0.0.0 --port=8000