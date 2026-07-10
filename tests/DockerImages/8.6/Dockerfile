# PHP 8.6 is still pre-release: the official library has no `php:8.6.<patch>-alpine`
# tag yet, only the floating `-rc` channel (currently 8.6.0alpha1). tests/cache/php-versions.json
# records the patch as "8.6-rc" so PHP_PATCH resolves to that tag. Once a stable 8.6.0 ships this
# pins to the exact patch like every other line.
ARG PHP_PATCH=8.6-rc
FROM php:${PHP_PATCH}-alpine

RUN set -eux; \
    apk add --repository http://dl-cdn.alpinelinux.org/alpine/edge/community --no-cache --virtual .build-deps \
    bash gcc g++ make autoconf pkgconfig git \
    libmcrypt-dev imap-dev php-imap enchant2-dev bzip2-dev gettext-dev libxml2-dev php83-dev php-gd icu-dev \
    php-zip php-tidy php-intl libffi-dev openssl-dev php83-pear rabbitmq-c rabbitmq-c-dev librrd \
    libzip-dev rrdtool-dev gmp-dev yaml yaml-dev fann fann-dev openldap-dev librdkafka librdkafka-dev libcurl curl-dev \
    libpng-dev libpq-dev aspell-dev libjpeg-turbo-dev libpng-dev libwebp-dev freetype-dev freetds-dev unixodbc-dev

RUN docker-php-ext-configure gd --with-jpeg --with-webp --with-freetype
RUN docker-php-ext-configure pdo_odbc --with-pdo-odbc=unixODBC,/usr

RUN docker-php-ext-install ffi enchant zip gmp sockets intl gd ldap bz2 mysqli bcmath calendar dba  pcntl \
    pdo_mysql shmop sysvmsg sysvsem sysvshm xml soap pgsql pdo_pgsql pdo_dblib pdo_odbc
    # gettext exif opcache

WORKDIR /opt/project/phpstorm-stubs
