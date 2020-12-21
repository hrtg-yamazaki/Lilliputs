FROM php:7.3-fpm

ENV LANG C.UTF-8

RUN apt-get update \
    && apt-get install -y libzip-dev zlib1g-dev mariadb-client libpng-dev libmcrypt-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-install zip pdo_mysql opcache

RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

RUN mkdir /code
COPY . /code/
WORKDIR /code

COPY ./zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf
COPY ./php.ini /usr/local/etc/php/php.ini

COPY --from=composer:1.10.13 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1

ENV PATH $PATH:/usr/bin/composer/vendor/bin

RUN chown www-data storage/ -R

RUN composer update

EXPOSE 8000
