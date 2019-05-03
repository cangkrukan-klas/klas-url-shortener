FROM php:7-fpm

RUN apt-get update && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libmcrypt-dev libpng-dev && apt-get clean
RUN pecl install mcrypt-1.0.2 && docker-php-ext-enable mcrypt
RUN docker-php-ext-install -j$(nproc) iconv pdo_mysql && \
    docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ && \
    docker-php-ext-install -j$(nproc) gd