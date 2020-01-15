FROM php:7.4-fpm-alpine

COPY --from=composer:1.9 /usr/bin/composer /usr/bin/composer

COPY docker/nginx.conf /etc/nginx/conf.d/default.conf
COPY docker/supervisord.conf /etc/supervisord.conf

RUN apk add --no-cache --update nginx supervisor \
    && apk add --no-cache --update --virtual .build-deps \
        $PHPIZE_DEPS \
    && apk add --no-cache --update \
        imap-dev \
        openssl-dev \
        freetype-dev \
        libjpeg-turbo-dev \
        libpng-dev \
        libzip-dev \
    && pecl install xdebug \
    && docker-php-ext-configure gd \
    && PHP_OPENSSL=yes docker-php-ext-configure imap --with-imap-ssl \
    && docker-php-ext-configure zip \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        bcmath \
        gd \
        zip \
    && apk del .build-deps \
    && mkdir -p /run/nginx \
    && rm -rf /tmp/*

EXPOSE 80

CMD ["supervisord", "-c", "/etc/supervisord.conf"]
