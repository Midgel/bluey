# Build dos assets com Node.js
FROM node:18-alpine AS node-builder

WORKDIR /app

# Copiar arquivos
COPY package*.json ./

# Instalar dependências do Node.js
RUN npm ci

# Copiar código fonte da aplicação
COPY . .

# Build dos assets para vite
RUN npm run build

# Usar imagem do PHP com FPM
FROM php:8.2-fpm AS base

# Dependências PHP + Nginx + Supervisor
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip git unzip curl \
    libonig-dev libzip-dev nginx supervisor \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install gd pdo pdo_mysql zip opcache \
 && rm -rf /var/lib/apt/lists/*

# Copiar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiar composer files e instalar dependências do PHP
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Copiar código da aplicação
COPY . .

# Copiar assets compilados
COPY --from=node-builder /app/public/build ./public/build

# Finalizar instalação do composer
RUN composer dump-autoload --optimize

# Comandos Laravel com limpeza de cache
RUN php artisan config:clear \
 && php artisan route:clear \
 && php artisan view:clear

# Ajuste de permissões
RUN chown -R www-data:www-data /var/www/html \
 && chmod -R 775 storage bootstrap/cache

# Limpar configurações padrão do Nginx
RUN rm -f /etc/nginx/sites-enabled/default \
 && rm -f /etc/nginx/conf.d/*

# Copia configuração do Nginx
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Copia Supervisor
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Criar logs directory
RUN mkdir -p /var/log/supervisor

# Expor porta 80
EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]