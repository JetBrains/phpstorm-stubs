FROM php:7.3
RUN set -x \
    && apt-get update \
    && apt-get install -y libldap2-dev libxml2-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
    && docker-php-ext-install ldap \
    && apt-get purge -y --auto-remove libldap2-dev
RUN docker-php-ext-install mysqli bcmath calendar dba exif gettext opcache pcntl pdo_mysql shmop sysvmsg sysvsem sysvshm soap xmlrpc

