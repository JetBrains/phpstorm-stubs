FROM php:7.3

ENV COMPOSER_ALLOW_SUPERUSER=1

# Install some base extensions
RUN set -ex; \
    apt-get update; \
    apt-get install -y \
        libzip-dev \
        zip; \
    docker-php-ext-configure zip --with-libzip; \
    docker-php-ext-install zip;

# Install Composoer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"; \
    php -r "if (hash_file('sha384', 'composer-setup.php') === '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"; \
    php composer-setup.php --install-dir=/usr/bin/ --filename=composer; \
    php -r "unlink('composer-setup.php');"; \
    composer self-update

# Install dependencies
COPY composer.json composer.json
COPY composer.lock composer.lock
RUN composer install --prefer-dist --no-scripts --no-suggest --no-autoloader \
    && rm -rf /root/.composer

# Copy codebase
COPY . ./

# Finish to install dependencies
RUN composer dump-autoload --no-scripts
