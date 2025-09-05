# Usa uma imagem base com PHP e FPM, ideal para servidores web
FROM php:8.2-fpm-alpine

# Instala as dependências do sistema e extensões PHP necessárias
# curl, pdo_mysql e pdo_sqlite são essenciais
# zip, gd, e outras são comuns em apps Laravel
RUN apk add --no-cache \
    curl \
    mysql-client \
    zip \
    libzip-dev \
    && docker-php-ext-install pdo_mysql zip

# Define o diretório de trabalho dentro do contêiner
WORKDIR /var/www/html

# Copia apenas os arquivos do Composer para aproveitar o cache
COPY composer.json composer.lock ./


# Instala o Composer e as dependências
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --no-interaction --no-autoloader --no-scripts

# Copia o restante da aplicação
COPY . .

# Expõe a porta 9000 para a comunicação com o servidor web (Nginx/Apache)
EXPOSE 8000
EXPOSE 9000

# Comando para iniciar o PHP-FPM quando o contêiner rodar
CMD ["php-fpm"]