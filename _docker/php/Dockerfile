FROM php:8.3-fpm

RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

RUN mkdir -p /var/www/storage /var/www/bootstrap/cache

RUN usermod -u 1000 www-data
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

WORKDIR /var/www
USER www-data