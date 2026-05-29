FROM php:8.4-alpine

RUN echo 'memory_limit = 2048M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini
COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /opt/project/phpstorm-stubs
