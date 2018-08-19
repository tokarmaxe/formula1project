FROM php:7.2.8-fpm

# install main dependencies

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
  && rm -rf /var/lib/apt/lists/*

# install sub dependencies

RUN rm /etc/apt/preferences.d/no-debian-php

RUN apt-get update -yqq && \
    apt-get -y install libxml2-dev php-soap && \
    docker-php-ext-install soap && \
    docker-php-ext-install zip && \
    docker-php-ext-install bcmath && \
    docker-php-ext-install pdo_mysql && \
    docker-php-ext-install pdo_pgsql && \
    docker-php-ext-configure gd \
    --enable-gd-native-ttf \
    --with-jpeg-dir=/usr/lib \
    --with-freetype-dir=/usr/include/freetype2 && \
    docker-php-ext-install gd

# install xdebug dependencies

RUN pecl install xdebug && \
        docker-php-ext-enable xdebug

# install mcrypt dependencies

RUN pecl install mcrypt-1.0.1 && \
        docker-php-ext-enable mcrypt

COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# install redis extension

RUN printf "\n" | pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

# install mongo extension

RUN pecl install mongodb && \
    docker-php-ext-enable mongodb

# install OpCache extension

RUN docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install opcache

# install Composer

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Run Composer Install

RUN composer global require hirak/prestissimo

COPY ./laravel.ini /usr/local/etc/php/conf.d
COPY ./xlaravel.pool.conf /usr/local/etc/php-fpm.d/

WORKDIR /var/www

CMD ["php-fpm", "--allow-to-run-as-root"]

EXPOSE 9000
