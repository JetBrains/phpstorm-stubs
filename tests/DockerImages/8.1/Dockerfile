FROM php:8.1-alpine

RUN set -eux; \
    apk add --repository http://dl-cdn.alpinelinux.org/alpine/edge/community --no-cache --virtual .build-deps \
    bash gcc g++ make autoconf pkgconfig git \
    libmcrypt-dev imap-dev php-imap bzip2-dev gettext-dev libxml2-dev php83-dev php-gd icu-dev \
    php-zip php-tidy php-intl libffi-dev openssl-dev php83-pear rabbitmq-c rabbitmq-c-dev librrd \
    libzip-dev rrdtool-dev gmp-dev yaml yaml-dev fann fann-dev openldap-dev librdkafka librdkafka-dev libcurl curl-dev \
    libpng-dev gpgme gpgme-dev libpq-dev aspell-dev libjpeg-turbo-dev libpng-dev libwebp-dev freetype-dev libxslt-dev \
    tidyhtml-dev

RUN docker-php-ext-configure gd --with-jpeg --with-webp --with-freetype

RUN docker-php-ext-install pgsql pdo_pgsql tidy zip xsl imap gmp sockets intl gd ldap bz2 mysqli bcmath calendar dba exif gettext opcache pcntl \
    pdo_mysql shmop sysvmsg sysvsem sysvshm xml soap pgsql pspell ftp

WORKDIR /opt/project/phpstorm-stubs
