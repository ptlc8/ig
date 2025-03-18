FROM php:8-fpm-alpine

#ARG PHP_ENV=production # can be "development"
ARG PHP_ENV=development
RUN mv "$PHP_INI_DIR/php.ini-"${PHP_ENV} "$PHP_INI_DIR/php.ini"

WORKDIR /srv

COPY public/* ./

EXPOSE 9000

CMD ["php-fpm"]
