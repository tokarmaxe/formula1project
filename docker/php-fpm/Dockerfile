FROM php:7.2-fpm
# Allow Composer to be run as root
ENV COMPOSER_ALLOW_SUPERUSER 1
WORKDIR /var/www
COPY .  /var/www

#https://github.com/ezsystems/docker-php/blob/master/php/Dockerfile-7.2
RUN apt-get update && apt-get install -y unzip 

# Setup the Composer installer
RUN curl -o /tmp/composer-setup.php https://getcomposer.org/installer \
  && curl -o /tmp/composer-setup.sig https://composer.github.io/installer.sig \
  && php -r "if (hash('SHA384', file_get_contents('/tmp/composer-setup.php')) !== trim(file_get_contents('/tmp/composer-setup.sig'))) { unlink('/tmp/composer-setup.php'); echo 'Invalid installer' . PHP_EOL; exit(1); }" \
  && php /tmp/composer-setup.php \
  # mysql
   && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
  && chmod a+x composer.phar \

  && mv composer.phar /usr/local/bin/composer 

  RUN ln -s /var/www/artisan /usr/local/bin/ \
&& ln -s /vendor/bin/phpunit /usr/local/bin/

  CMD ["php-fpm"]
