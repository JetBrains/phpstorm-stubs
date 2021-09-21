FROM php:8.1.0RC2-alpine

RUN set -eux; \
    apk add --no-cache --virtual .build-deps \
    bash gcc g++ make autoconf pkgconfig git \
    libmcrypt-dev imap-dev php8-imap enchant2 php8-enchant bzip2-dev gettext-dev libxml2-dev php8-dev php8-gd icu-dev \
    php8-zip php8-tidy php8-intl libffi-dev openssl-dev php8-pear php7-pecl-amqp  rabbitmq-c rabbitmq-c-dev librrd \
    libzip-dev rrdtool-dev gmp-dev yaml yaml-dev fann fann-dev openldap-dev librdkafka librdkafka-dev libcurl curl-dev \
    gpgme gpgme-dev git

RUN docker-php-ext-install imap gmp sockets intl gd ldap bz2 mysqli bcmath calendar dba exif gettext opcache pcntl \
    pdo_mysql shmop sysvmsg sysvsem sysvshm xml soap

RUN git clone https://github.com/xdebug/xdebug
WORKDIR xdebug
RUN phpize && \
    chmod +x configure && \
    ./configure --enable-xdebug && \
    make && \
    make install
RUN docker-php-ext-enable xdebug

RUN echo 'memory_limit = 1024M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini