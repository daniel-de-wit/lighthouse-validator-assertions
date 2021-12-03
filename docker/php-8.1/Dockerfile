FROM php:8.1-cli-alpine

WORKDIR /var/www/html

RUN apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
    && pecl install \
        pcov \
    && docker-php-ext-enable \
        pcov \
    && apk del -f .build-deps \
    && apk add git

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
