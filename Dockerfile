FROM php:7.4
RUN set -x \
    && apt-get update \
    && apt-get install -y libldap2-dev libxml2-dev librabbitmq-dev libssh-dev libbz2-dev libevent-dev libfann-dev libgpgme11-dev librdkafka-dev librrd-dev libyaml-dev libcurl4-openssl-dev\
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
    && docker-php-ext-install ldap \
    && apt-get purge -y --auto-remove libldap2-dev
RUN docker-php-ext-install bz2 mysqli bcmath calendar dba exif gettext opcache pcntl pdo_mysql shmop sysvmsg sysvsem sysvshm soap xmlrpc
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