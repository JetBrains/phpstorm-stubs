FROM php:7.2-alpine

RUN set -eux; \
    apk add --no-cache --virtual .build-deps \
    bash gcc g++ make autoconf pkgconfig git \
    libmcrypt-dev imap-dev php7-imap php7-enchant bzip2-dev gettext-dev libxml2-dev php7-dev php7-gd icu-dev \
    php7-zip php7-tidy php7-intl libffi-dev openssl-dev php7-pear rabbitmq-c rabbitmq-c-dev librrd \
    libzip-dev rrdtool-dev gmp-dev yaml yaml-dev fann fann-dev openldap-dev librdkafka librdkafka-dev libcurl curl-dev \
    libpng-dev aspell-dev libjpeg-turbo-dev libpng-dev libwebp-dev freetype-dev

RUN docker-php-ext-configure gd --with-freetype-dir=/usr --with-png-dir=/usr --with-webp-dir=/usr --with-jpeg-dir=/usr

RUN docker-php-ext-install wddx imap gmp sockets intl gd ldap bz2 mysqli bcmath calendar dba exif gettext opcache pcntl \
    pdo_mysql shmop sysvmsg sysvsem sysvshm xml soap pspell ftp

WORKDIR /opt/project/phpstorm-stubs
