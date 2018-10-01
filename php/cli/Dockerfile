ARG PHP_VERSION=7.2
FROM php:${PHP_VERSION}-cli

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
    libmcrypt-dev \
    nano


## Extensions ###########################################

RUN docker-php-ext-install pdo_mysql \
  && docker-php-ext-install pdo_pgsql
#  && docker-php-ext-install pgsql \
#  && docker-php-ext-install mysqli

RUN docker-php-ext-install gd \
	&& docker-php-ext-install opcache \
	&& docker-php-ext-install tokenizer \
	&& docker-php-ext-install bcmath \
	&& docker-php-ext-install calendar

RUN docker-php-ext-configure gd \
    --enable-gd-native-ttf \
    --with-jpeg-dir=/usr/lib \
    --with-freetype-dir=/usr/include/freetype2 && \
    docker-php-ext-install gd

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

# Install memcached extension
RUN  curl -L -o /tmp/memcached.tar.gz "https://github.com/php-memcached-dev/php-memcached/archive/php7.tar.gz" \
    && mkdir -p memcached \
    && tar -C memcached -zxvf /tmp/memcached.tar.gz --strip 1 \
    && ( \
        cd memcached \
        && phpize \
        && ./configure \
        && make -j$(nproc) \
        && make install \
    ) \
    && rm -r memcached \
    && rm /tmp/memcached.tar.gz \
    && docker-php-ext-enable memcached

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
