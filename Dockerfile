# Gunakan image PHP FPM dengan versi yang sesuai
FROM php:8.2-fpm-alpine

# Instal dependensi sistem yang dibutuhkan
RUN apk add --no-cache \
    nginx \
    supervisor \
    mysql-client \
    git \
    curl \
    libxml2-dev \
    freetype-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    nodejs \
    npm

# Instal ekstensi PHP yang dibutuhkan Laravel
RUN docker-php-ext-install pdo pdo_mysql opcache \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Atur direktori kerja
WORKDIR /var/www/html

# Salin semua kode aplikasi (TIDAK TERMASUK folder vendor dan node_modules)
COPY --chown=www-data:www-data . .

# Hapus file .env yang mungkin tersisa dari lokal (karena Coolify akan menyediakan yang baru)
RUN rm -f .env

# Instal composer dan dependensi PHP
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# >>> BARIS KRUSIAL BARU: Bersihkan cache yang mungkin menghalangi PHP-FPM start
RUN php artisan config:clear
RUN php artisan cache:clear
# <<< END BARIS KRUSIAL BARU

# Atur izin file (PENTING untuk Laravel)
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# -------------------------------------------------------------
# KONFIGURASI NGINX & SUPERVISOR & PHP-FPM
# -------------------------------------------------------------

# Salin konfigurasi PHP-FPM untuk menggunakan socket UNIX
COPY php-fpm-www.conf /usr/local/etc/php-fpm.d/www.conf

# Salin konfigurasi Nginx ke direktori Nginx
COPY default.conf /etc/nginx/conf.d/default.conf

# Salin konfigurasi Supervisor
COPY supervisord.conf /etc/supervisord.conf

# Hapus folder default Nginx, karena kita menggunakan konfigurasi baru
RUN rm -rf /var/www/html/public/default.html

# Bersihkan cache npm
RUN npm cache clean --force

# Atur hak akses untuk script (opsional)
RUN chmod +x /usr/bin/supervisord

# Expose port yang digunakan Nginx
EXPOSE 80

# Jalankan Supervisor saat container start
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]