# FROM php:8.2-fpm AS base

# # Dependências PHP + Nginx + Supervisor
# RUN apt-get update && apt-get install -y \
#     libpng-dev libjpeg-dev libfreetype6-dev zip git unzip curl libonig-dev libzip-dev nginx supervisor \
#  && docker-php-ext-configure gd --with-freetype --with-jpeg \
#  && docker-php-ext-install gd pdo pdo_mysql zip opcache \
#  && rm -rf /var/lib/apt/lists/*

# # Composer
# COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# # Código da aplicação
# WORKDIR /var/www/html
# COPY . .

# # Dependências Laravel
# RUN composer install --no-dev --optimize-autoloader --no-interaction \
#  && php artisan config:clear \
#  && php artisan route:clear \
#  && php artisan view:clear 

# # Permissões
# RUN chown -R www-data:www-data storage bootstrap/cache \
#  && chmod -R 775 storage bootstrap/cache

# # Limpa configs padrão do Nginx
# RUN rm -f /etc/nginx/conf.d/*

# # Copia configuração do Nginx
# COPY nginx.conf /etc/nginx/conf.d/default.conf

# # Copia Supervisor
# COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# # Expondo porta HTTP
# EXPOSE 80

# # Start Supervisor
# CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]


# Stage 1: Build assets with Node.js
FROM node:18-alpine AS node-builder

WORKDIR /app

# Copy package files
COPY package*.json ./

# Install Node dependencies
RUN npm ci

# Copy source code
COPY . .

# Build assets
RUN npm run build

# Stage 2: PHP application
FROM php:8.2-fpm AS base

# Dependências PHP + Nginx + Supervisor
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip git unzip curl \
    libonig-dev libzip-dev nginx supervisor \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install gd pdo pdo_mysql zip opcache \
 && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiar composer files primeiro (para cache)
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Copiar código da aplicação
COPY . .

# Copiar assets compilados do stage anterior
COPY --from=node-builder /app/public/build ./public/build

# Finalizar instalação do composer
RUN composer dump-autoload --optimize

# Comandos Laravel
RUN php artisan config:cache \
 && php artisan route:cache \
 && php artisan view:cache

# Permissões (MUITO IMPORTANTE)
RUN chown -R www-data:www-data /var/www/html \
 && chmod -R 775 storage bootstrap/cache

# Limpa configs padrão do Nginx
RUN rm -f /etc/nginx/sites-enabled/default \
 && rm -f /etc/nginx/conf.d/*

# Copia configuração do Nginx
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Copia Supervisor
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Criar logs directory
RUN mkdir -p /var/log/supervisor

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]