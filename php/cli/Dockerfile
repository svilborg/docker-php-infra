ARG PHP_VERSION=7.2
FROM php:${PHP_VERSION}-fpm

RUN apt-get update \
  && apt-get install -y --no-install-recommends \
    curl \
    libmemcached-dev \
    libz-dev \
    libpq-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libssl-dev \
    libmcrypt-dev


## Extensions ###########################################
RUN docker-php-ext-install pdo_mysql \
  && docker-php-ext-install pdo_pgsql \
  && docker-php-ext-install pgsql \
  && docker-php-ext-install mysqli

RUN docker-php-ext-install gd
RUN docker-php-ext-install opcache
RUN docker-php-ext-install tokenizer
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install calendar

## PECL ##########################################
RUN pecl channel-update pecl.php.net

RUN pecl install -o -f redis \
    &&  docker-php-ext-enable redis

RUN pecl install mongodb && \
    docker-php-ext-enable mongodb

RUN apt-get update && apt-get install -y libmagickwand-dev \
    && pecl install imagick \
    && docker-php-ext-enable imagick

RUN apt-get install librabbitmq-dev -y && \
    pecl install amqp && \
    docker-php-ext-enable amqp


## Mysql Client ##################################
RUN apt-get -y install mysql-client


## Composer #######################################
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


USER root

# Clean up
RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
    rm /var/log/lastlog /var/log/faillog

RUN usermod -u 1000 www-data

WORKDIR /var/www

