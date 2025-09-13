FROM php:8.2-fpm AS base

# Dependências PHP
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip git unzip curl libonig-dev libzip-dev nginx supervisor \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install gd pdo pdo_mysql zip opcache \
 && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Código da aplicação
WORKDIR /var/www/html
COPY . .

# Dependências Laravel
RUN composer install --no-dev --optimize-autoloader --no-interaction \
 && php artisan config:clear \
 && php artisan route:clear \
 && php artisan view:clear

# Permissões
RUN chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

RUN rm -f /etc/nginx/conf.d/*

# Copia configuração do Nginx
COPY ./nginx.conf /etc/nginx/conf.d/default.conf

# Supervisor para gerenciar os dois processos
COPY ./supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
