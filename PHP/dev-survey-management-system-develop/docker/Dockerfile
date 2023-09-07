FROM php:8.1-apache
COPY ./php/php.ini /usr/local/etc/php/
COPY ./apache/*.conf /etc/apache2/sites-enabled/

RUN  a2enmod rewrite

RUN apt-get update \
  && apt-get install -y zlib1g-dev libpq-dev libzip-dev mariadb-client unzip\
  && docker-php-ext-install zip pdo_mysql mysqli \
  && docker-php-ext-enable mysqli

RUN apt-get update && apt-get install -y libzip-dev libpng-dev && docker-php-ext-install zip gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin

WORKDIR /var/www/html/public

RUN composer global require "laravel/installer"
