FROM php:8.3-apache

RUN echo 'memory_limit = 2048M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini
COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get -y install git zip unzip
RUN apt-get update -y && \
    apt-get install git -y && \
    git clone https://github.com/xdebug/xdebug
WORKDIR xdebug
RUN phpize && \
    chmod +x configure && \
    ./configure --enable-xdebug && \
    make && \
    make install
# Enable xdebug extension
RUN echo "zend_extension=$(php-config --extension-dir)/xdebug.so" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.mode=develop,debug,coverage" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/php.ini
RUN echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.output_dir=/opt/project/xdebug_snapshots" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.log=/opt/project/xdebug_logs/xdebug33php82.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
WORKDIR /opt/project/phpstorm-stubs
