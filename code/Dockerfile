FROM php:7.3-fpm

RUN apt-get update \
    && apt-get install -y libzip-dev zlib1g-dev mariadb-client \
    && docker-php-ext-install zip pdo_mysql opcache

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
