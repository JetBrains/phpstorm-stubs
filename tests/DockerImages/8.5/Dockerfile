ARG PHP_PATCH=8.5
FROM php:${PHP_PATCH}-alpine

# Same limit every other version's image sets. Stage 1 wraps every internal entity in memory before
# serializing, and that grows with each extension restored below.
RUN echo 'memory_limit = 2048M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini
# See the 8.4 image for why odbc needs this config.m4 patch. odbc, tidy, xsl, exif, gettext and ftp
# had all silently dropped out of this image; everything they declare was invisible to the validators
# at 8.5, which PhpVersionsSyncTest::testExtensionCoverageNeverRegressesBetweenVersions now catches.
RUN set -eux; \
    docker-php-source extract; \
            { \
                    echo '# https://github.com/docker-library/php/issues/103#issuecomment-271413933'; \
                    echo 'AC_DEFUN([PHP_ALWAYS_SHARED],[])dnl'; \
                    echo; \
                    cat /usr/src/php/ext/odbc/config.m4; \
            } > temp.m4; \
            mv temp.m4 /usr/src/php/ext/odbc/config.m4; \
    apk add --repository http://dl-cdn.alpinelinux.org/alpine/edge/community --no-cache --virtual .build-deps \
    bash gcc g++ make autoconf pkgconfig git \
    libmcrypt-dev imap-dev php-imap enchant2-dev bzip2-dev gettext-dev libxml2-dev php83-dev php-gd icu-dev \
    php-zip php-tidy php-intl libffi-dev openssl-dev php83-pear rabbitmq-c rabbitmq-c-dev librrd \
    libzip-dev rrdtool-dev gmp-dev yaml yaml-dev fann fann-dev openldap-dev librdkafka librdkafka-dev libcurl curl-dev \
    libpng-dev libpq-dev aspell-dev libjpeg-turbo-dev libpng-dev libwebp-dev freetype-dev freetds-dev \
    libxslt-dev tidyhtml-dev unixodbc-dev

RUN docker-php-ext-configure gd --with-jpeg --with-webp --with-freetype
RUN docker-php-ext-configure odbc --with-unixODBC=shared,/usr
RUN docker-php-ext-configure pdo_odbc --with-pdo-odbc=unixODBC,/usr

# opcache is not listed: this base image already ships it enabled, and installing it again fails.
# imap and pspell are absent because PHP 8.4 unbundled them to PECL.
RUN docker-php-ext-install ffi enchant odbc tidy xsl zip gmp sockets intl gd ldap bz2 mysqli bcmath calendar dba exif \
    gettext pcntl pdo_mysql shmop sysvmsg sysvsem sysvshm xml soap pgsql pdo_pgsql ftp pdo_dblib pdo_odbc

WORKDIR /opt/project/phpstorm-stubs
