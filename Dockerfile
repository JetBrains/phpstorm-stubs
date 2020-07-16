FROM php:8.0.0alpha2-alpine
RUN echo 'memory_limit = 256M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini
COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN set -eux; \
    apk add --no-cache --virtual .build-deps \
    gcc g++ make autoconf pkgconfig \
    bzip2-dev gettext-dev libxml2-dev php7-dev libffi-dev openssl-dev php7-pear php7-pecl-amqp  rabbitmq-c rabbitmq-c-dev \
    librrd rrdtool-dev yaml yaml-dev fann fann-dev openldap-dev librdkafka librdkafka-dev libcurl curl-dev gpgme gpgme-dev
RUN docker-php-ext-install ldap bz2 mysqli bcmath calendar dba exif gettext opcache pcntl pdo_mysql shmop sysvmsg \
    sysvsem sysvshm xml soap

#Extensions below require a lot of fixes
#RUN pecl install mongodb
#RUN docker-php-ext-enable mongodb
#RUN pecl install rdkafka
#RUN docker-php-ext-enable rdkafka
#RUN pecl install yaf
#RUN docker-php-ext-enable yaf
#RUN pecl install yar
#RUN docker-php-ext-enable yar
#RUN pecl install gnupg
#RUN docker-php-ext-enable gnupg
#RUN pecl install uopz
#RUN docker-php-ext-enable uopz