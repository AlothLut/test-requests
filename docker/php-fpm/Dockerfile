FROM php:8.0-fpm

RUN apt-get update && apt-get install -y \
    build-essential \
    git \
    && pecl install \
        xdebug \
    && docker-php-ext-enable \
        xdebug \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

RUN usermod -u 1000 www-data

EXPOSE 9000

CMD ["php-fpm"]