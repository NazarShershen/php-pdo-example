FROM php:7.3-fpm

RUN curl -sS https://getcomposer.org/installer | php -- \
  --install-dir=/usr/bin/ --filename=composer

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git \
                       libzip-dev \
                       zip \
    && apt-get install -y wget unzip \
    && pecl install xdebug-2.7.1 \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo pdo_mysql

WORKDIR /code
