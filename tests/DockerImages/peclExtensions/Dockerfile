FROM php:8.1-alpine

RUN set -eux; \
    apk add --no-cache --virtual .build-deps \
    bash gcc g++ make autoconf pkgconfig git \
    libmcrypt-dev imap-dev enchant2 bzip2-dev gettext-dev libxml2-dev icu-dev \
    libffi-dev openssl-dev rabbitmq-c rabbitmq-c-dev librrd \
    libzip-dev rrdtool-dev gmp-dev yaml yaml-dev fann fann-dev openldap-dev librdkafka librdkafka-dev libcurl curl-dev \
    libpng-dev gpgme gpgme-dev linux-pam-dev

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
#RUN pecl install xmlrpc
#RUN docker-php-ext-enable xmlrpc
#RUN pecl install amqp
#RUN docker-php-ext-enable amqp
RUN pecl install Ev
RUN docker-php-ext-enable ev
#RUN pecl install fann
#RUN docker-php-ext-enable fann
RUN pecl install igbinary
RUN docker-php-ext-enable igbinary
RUN pecl install inotify
RUN docker-php-ext-enable inotify
RUN pecl install msgpack
RUN docker-php-ext-enable msgpack
#RUN pecl install rrd
#RUN docker-php-ext-enable rrd
RUN pecl install sync
RUN docker-php-ext-enable sync
RUN pecl install yaml
RUN docker-php-ext-enable yaml
RUN pecl install pcov
RUN docker-php-ext-enable pcov
RUN pecl install mcrypt
RUN docker-php-ext-enable mcrypt
RUN pecl install zip
RUN docker-php-ext-enable zip
#RUN pecl install mongodb
#RUN docker-php-ext-enable mongodb
RUN pecl install rdkafka
RUN docker-php-ext-enable rdkafka
RUN pecl install yaf
RUN docker-php-ext-enable yaf
RUN pecl install yar
RUN docker-php-ext-enable yar
RUN pecl install gnupg
RUN docker-php-ext-enable gnupg
#RUN pecl install uopz
#RUN docker-php-ext-enable uopz
RUN pecl install pam
RUN docker-php-ext-enable pam

WORKDIR /opt/project/phpstorm-stubs
