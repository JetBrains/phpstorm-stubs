FROM php:7.4-alpine

#Install composer in docker container

RUN set -eux; \
  apk add --no-cache --virtual .composer-rundeps \
    bash \
    coreutils \
    git \
    make \
    mercurial \
    openssh-client \
    patch \
    subversion \
    tini \
    unzip \
    zip

RUN set -eux; \
  apk add --no-cache --virtual .build-deps \
    libzip-dev \
    zlib-dev \
  ; \
  docker-php-ext-install -j "$(nproc)" \
    zip \
  ; \
  runDeps="$( \
    scanelf --needed --nobanner --format '%n#p' --recursive /usr/local/lib/php/extensions \
      | tr ',' '\n' \
      | sort -u \
      | awk 'system("[ -e /usr/local/lib/" $1 " ]") == 0 { next } { print "so:" $1 }' \
    )"; \
  apk add --no-cache --virtual .composer-phpext-rundeps $runDeps; \
  apk del .build-deps

RUN printf "# composer php cli ini settings\n\
date.timezone=UTC\n\
memory_limit=-1\n\
" > $PHP_INI_DIR/php-cli.ini

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /tmp
ENV COMPOSER_VERSION 1.9.3

RUN set -eux; \
  curl --silent --fail --location --retry 3 --output /tmp/installer.php --url \
  https://raw.githubusercontent.com/composer/getcomposer.org/cb19f2aa3aeaa2006c0cd69a7ef011eb31463067/web/installer; \
  php -r " \
    \$signature = '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5'; \
    \$hash = hash('sha384', file_get_contents('/tmp/installer.php')); \
    if (!hash_equals(\$signature, \$hash)) { \
      unlink('/tmp/installer.php'); \
      echo 'Integrity check failed, installer is either corrupt or worse.' . PHP_EOL; \
      exit(1); \
    }"; \
  php /tmp/installer.php --no-ansi --install-dir=/usr/bin --filename=composer --version=${COMPOSER_VERSION}; \
  composer --ansi --version --no-interaction; \
  rm -f /tmp/installer.php; \
  find /tmp -type d -exec chmod -v 1777 {} +

COPY docker-entrypoint.sh /docker-entrypoint.sh

WORKDIR /app

ENTRYPOINT ["sh", "/docker-entrypoint.sh"]

CMD ["composer"]

#Install required for tests extensions

RUN set -eux; \
    apk add --no-cache --virtual .build-deps \
    gcc g++ make autoconf pkgconfig \
    bzip2-dev gettext-dev libxml2-dev php7-dev libffi-dev openssl-dev php7-pear php7-pecl-amqp  rabbitmq-c rabbitmq-c-dev \
    librrd rrdtool-dev yaml yaml-dev fann fann-dev openldap-dev
RUN docker-php-ext-install ldap bz2 mysqli bcmath calendar dba exif gettext opcache pcntl pdo_mysql shmop sysvmsg \
    sysvsem sysvshm xml soap xmlrpc
RUN pecl install amqp
RUN docker-php-ext-enable amqp
RUN pecl install Ev
RUN docker-php-ext-enable ev
RUN pecl install fann
RUN docker-php-ext-enable fann
RUN pecl install igbinary
RUN docker-php-ext-enable igbinary
RUN pecl install inotify
RUN docker-php-ext-enable inotify
RUN pecl install msgpack
RUN docker-php-ext-enable msgpack
RUN pecl install rrd
RUN docker-php-ext-enable rrd
RUN pecl install sync
RUN docker-php-ext-enable sync
RUN pecl install yaml
RUN docker-php-ext-enable yaml
RUN pecl install pcov
RUN docker-php-ext-enable pcov
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