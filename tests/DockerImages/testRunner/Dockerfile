FROM php:8.4.1-alpine

RUN echo 'memory_limit = 2048M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini
COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN set -eux; \
    apk add --repository http://dl-cdn.alpinelinux.org/alpine/edge/community --no-cache --virtual .build-deps \
    bash gcc g++ make autoconf pkgconfig git \
    libmcrypt-dev imap-dev php-imap enchant2 php-enchant bzip2-dev gettext-dev libxml2-dev php83-dev php-gd icu-dev \
    php-zip php-tidy php-intl libffi-dev openssl-dev php83-pear rabbitmq-c rabbitmq-c-dev librrd \
    libzip-dev rrdtool-dev gmp-dev yaml yaml-dev fann fann-dev openldap-dev librdkafka librdkafka-dev libcurl curl-dev \
    libpng-dev gpgme gpgme-dev libpq-dev aspell-dev libjpeg-turbo-dev libpng-dev libwebp-dev freetype-dev

RUN docker-php-ext-configure gd --with-jpeg --with-webp --with-freetype

RUN docker-php-ext-install gmp sockets intl gd ldap bz2 mysqli bcmath calendar dba exif gettext opcache pcntl \
    pdo_mysql shmop sysvmsg sysvsem sysvshm xml soap pgsql

#RUN apk --no-cache update && \
#    apk --no-cache add git zip unzip autoconf build-base php82 php82-dev linux-headers
#RUN git clone https://github.com/xdebug/xdebug
#WORKDIR xdebug
#RUN phpize && \
#    ./configure --enable-xdebug && \
#    make && \
#    make install
# Enable xdebug extension
#RUN echo "zend_extension=$(php-config --extension-dir)/xdebug.so" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
#RUN echo "xdebug.mode=develop,debug,coverage" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
#RUN echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/php.ini
#RUN echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
#RUN echo "xdebug.output_dir=/opt/project/xdebug_snapshots" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
#RUN echo "xdebug.log=/opt/project/phpstorm-stubs/xdebug_logs/xdebug.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
WORKDIR /opt/project/phpstorm-stubs
