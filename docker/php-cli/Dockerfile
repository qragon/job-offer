FROM php:8.3.2-cli

RUN apt-get update && apt-get install -y libpq-dev unzip \
    && docker-php-ext-install pdo pdo_mysql \
    && apt-get install -y libjpeg-dev libpng-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

COPY ./docker/php-cli/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

WORKDIR /app
