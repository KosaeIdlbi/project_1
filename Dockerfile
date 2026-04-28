FROM php:8.2-apache

# ============================================
# 1. تثبيت الحزم الأساسية
# ============================================
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libpq-dev \
    supervisor \
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql pdo_pgsql mbstring zip exif pcntl gd bcmath \
    && rm -rf /var/lib/apt/lists/*

# ============================================
# 2. تثبيت Composer
# ============================================
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ============================================
# 3. إعدادات Apache و PHP
# ============================================
RUN a2enmod rewrite

RUN echo "display_errors = On" >> /usr/local/etc/php/conf.d/errors.ini \
    && echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/errors.ini

# ============================================
# 4. إعداد مجلد العمل ونسخ الملفات
# ============================================
WORKDIR /var/www/html
COPY . /var/www/html

# ============================================
# 5. تثبيت Dependencies
# ============================================
RUN composer install --optimize-autoloader --no-interaction
RUN composer require --dev fakerphp/faker --no-interaction
RUN npm install && npm run build

# ============================================
# 6. إعدادات Laravel
# ============================================
RUN php artisan storage:link
RUN php artisan optimize:clear

# ============================================
# 7. توجيه Apache لمجلد public
# ============================================
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# ============================================
# 8. إعداد Supervisor
# ============================================
RUN mkdir -p /var/log/supervisor

# إنشاء ملف تكوين Supervisor بطريقة صحيحة
RUN echo '[supervisord]' > /etc/supervisor/conf.d/supervisord.conf && \
    echo 'nodaemon=true' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'user=root' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'logfile=/var/log/supervisor/supervisord.log' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'pidfile=/var/run/supervisord.pid' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'loglevel=info' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo '' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo '[program:apache]' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'command=apache2-foreground' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'autostart=true' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'autorestart=true' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'stdout_logfile=/dev/stdout' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'stdout_logfile_maxbytes=0' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'stderr_logfile=/dev/stderr' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'stderr_logfile_maxbytes=0' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo '' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo '[program:npm-dev]' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'command=npm run dev' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'directory=/var/www/html' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'autostart=true' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'autorestart=true' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'stdout_logfile=/var/log/supervisor/npm-dev.log' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'stderr_logfile=/var/log/supervisor/npm-dev-error.log' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'user=root' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'environment=NODE_ENV="development"' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo '' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo '[program:queue-work]' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'command=php artisan queue:work --tries=3 --sleep=3 --timeout=60' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'directory=/var/www/html' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'autostart=true' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'autorestart=true' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'stdout_logfile=/var/log/supervisor/queue-work.log' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'stderr_logfile=/var/log/supervisor/queue-work-error.log' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'user=root' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo '' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo '[program:reverb]' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'command=php artisan reverb:start --debug' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'directory=/var/www/html' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'autostart=true' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'autorestart=true' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'stdout_logfile=/var/log/supervisor/reverb.log' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'stderr_logfile=/var/log/supervisor/reverb-error.log' >> /etc/supervisor/conf.d/supervisord.conf && \
    echo 'user=root' >> /etc/supervisor/conf.d/supervisord.conf

# ============================================
# 9. إعداد الصلاحيات
# ============================================
RUN chown -R www-data:www-data /var/www/html
RUN find /var/www/html -type d -exec chmod 775 {} \;
RUN find /var/www/html -type f -exec chmod 664 {} \;
RUN chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# ============================================
# 10. إنشاء Entrypoint Script
# ============================================
RUN echo '#!/bin/bash' > /usr/local/bin/entrypoint.sh && \
    echo '' >> /usr/local/bin/entrypoint.sh && \
    echo '# إنشاء المجلدات المطلوبة' >> /usr/local/bin/entrypoint.sh && \
    echo 'mkdir -p /var/log/supervisor' >> /usr/local/bin/entrypoint.sh && \
    echo 'mkdir -p /var/www/html/storage/logs' >> /usr/local/bin/entrypoint.sh && \
    echo '' >> /usr/local/bin/entrypoint.sh && \
    echo '# إعداد الصلاحيات مرة أخرى للتأكد' >> /usr/local/bin/entrypoint.sh && \
    echo 'chown -R www-data:www-data /var/www/html/storage' >> /usr/local/bin/entrypoint.sh && \
    echo 'chown -R www-data:www-data /var/www/html/bootstrap/cache' >> /usr/local/bin/entrypoint.sh && \
    echo '' >> /usr/local/bin/entrypoint.sh && \
    echo '# تنظيف الـ Cache' >> /usr/local/bin/entrypoint.sh && \
    echo 'php artisan config:clear' >> /usr/local/bin/entrypoint.sh && \
    echo 'php artisan cache:clear' >> /usr/local/bin/entrypoint.sh && \
    echo 'php artisan view:clear' >> /usr/local/bin/entrypoint.sh && \
    echo '' >> /usr/local/bin/entrypoint.sh && \
    echo '# تشغيل الـ Migrations إذا طُلب ذلك' >> /usr/local/bin/entrypoint.sh && \
    echo 'if [ "$RUN_MIGRATIONS" = "true" ]; then' >> /usr/local/bin/entrypoint.sh && \
    echo '    echo "Running migrations..."' >> /usr/local/bin/entrypoint.sh && \
    echo '    php artisan migrate --force' >> /usr/local/bin/entrypoint.sh && \
    echo 'fi' >> /usr/local/bin/entrypoint.sh && \
    echo '' >> /usr/local/bin/entrypoint.sh && \
    echo '# تشغيل الـ Seeders إذا طُلب ذلك' >> /usr/local/bin/entrypoint.sh && \
    echo 'if [ "$RUN_SEEDERS" = "true" ]; then' >> /usr/local/bin/entrypoint.sh && \
    echo '    echo "Running seeders..."' >> /usr/local/bin/entrypoint.sh && \
    echo '    php artisan db:seed --force' >> /usr/local/bin/entrypoint.sh && \
    echo 'fi' >> /usr/local/bin/entrypoint.sh && \
    echo '' >> /usr/local/bin/entrypoint.sh && \
    echo '# بدء Supervisor لإدارة جميع الخدمات' >> /usr/local/bin/entrypoint.sh && \
    echo 'echo "Starting Supervisor with all services (Apache, npm dev, queue, reverb)..."' >> /usr/local/bin/entrypoint.sh && \
    echo 'exec /usr/bin/supervisord -n -c /etc/supervisor/conf.d/supervisord.conf' >> /usr/local/bin/entrypoint.sh

RUN chmod +x /usr/local/bin/entrypoint.sh

# ============================================
# 11. فتح المنافذ
# ============================================
EXPOSE 80
EXPOSE 8080

# ============================================
# 12. نقطة الدخول
# ============================================
# ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["supervisord"]