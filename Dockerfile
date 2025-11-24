# Gunakan image PHP 8.2 FPM yang stabil dari Alpine untuk ukuran yang lebih kecil
FROM php:8.2-fpm-alpine

# Set Direktori Kerja di dalam container
WORKDIR /app

# Instal dependensi sistem yang dibutuhkan
# git: untuk composer, curl: utilitas web, mysql-client: untuk koneksi DB, supervisor & nginx: untuk menjalankan app
RUN apk add --no-cache \
    git \
    curl \
    mysql-client \
    supervisor \
    nginx \
    npm \
    make

# Instal ekstensi PHP yang umum dipakai di Laravel
RUN docker-php-ext-install pdo pdo_mysql opcache

# Instal Composer secara global
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Salin source code dari GitHub ke dalam container
COPY . .

# --- KONFIGURASI BUILD ---
# Instal dependensi PHP (tanpa --dev) dan jalankan build front-end (npm)
RUN composer install --no-dev --optimize-autoloader
RUN npm install
RUN npm run build
RUN php artisan storage:link
RUN php artisan optimize

# Atur izin direktori storage dan cache agar bisa ditulis oleh user web (www-data)
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

# Expose port yang akan digunakan Nginx di dalam container
EXPOSE 8080

# Jalankan Nginx dan PHP-FPM menggunakan Supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]