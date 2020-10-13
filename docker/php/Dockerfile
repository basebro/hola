FROM php:7.3-fpm

RUN docker-php-ext-install pdo_mysql

RUN pecl install apcu

RUN apt-get update && \
apt-get install -y \
libzip-dev

RUN docker-php-ext-install zip
RUN docker-php-ext-enable apcu

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY apps/hola/ /usr/src/app

WORKDIR /usr/src/app/

RUN php /usr/local/bin/composer install --no-progress --no-interaction --prefer-dist --no-suggest --optimize-autoloader

RUN PATH=$PATH:/usr/src/apps/vendor/bin:bin

CMD ["php-fpm"]