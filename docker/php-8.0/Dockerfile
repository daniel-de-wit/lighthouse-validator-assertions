FROM php:8.0-cli-alpine

WORKDIR /var/www/html

RUN apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
    && pecl install \
        pcov \
    && docker-php-ext-enable \
        pcov \
    && apk del -f .build-deps

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
