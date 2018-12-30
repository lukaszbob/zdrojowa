FROM php:7.2-cli
ENV DEBIAN_FRONTEND noninteractive
RUN apt-get update && apt-get install -y libgd-dev libjpeg-dev libjpeg62-turbo-dev libpng-dev libfreetype6-dev git libicu-dev \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd pdo_mysql pcntl bcmath zip intl
RUN pecl install xdebug && docker-php-ext-enable xdebug
COPY install-composer.sh /tmp/
RUN apt-get install -y wget && sh /tmp/install-composer.sh && mv /composer.phar /usr/local/bin/composer
COPY php.ini /usr/local/etc/php/
WORKDIR /var/www/symfony
CMD [ "php", "bin/console","server:run","0.0.0.0:8000" ]
