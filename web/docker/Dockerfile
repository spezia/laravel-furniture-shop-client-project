FROM php:7.4-apache

ENV APP_HOME /var/www/html

RUN echo "deb http://deb.debian.org/debian bullseye main" > /etc/apt/sources.list && \
    echo "deb http://deb.debian.org/debian bullseye-updates main" >> /etc/apt/sources.list && \
    echo "deb http://deb.debian.org/debian-security bullseye-security main" >> /etc/apt/sources.list && \
    apt-get update && apt-get install --yes curl apt-utils && \
    apt-get clean

COPY ./docker/app.conf /etc/apache2/sites-available/app.conf

RUN a2enmod rewrite && a2ensite app.conf && \
    apt-get update && apt-get install --yes \
    libpq-dev zlib1g-dev cron g++ wget libonig-dev libzip-dev \
    gettext libicu-dev libc-client-dev libkrb5-dev libxml2-dev \
    libfreetype6-dev libgd-dev bzip2 libbz2-dev \
    libtidy-dev libz-dev libmemcached-dev libxslt-dev vim \
    gzip bash libgmp-dev libmagickwand-dev \
    --no-install-recommends && \
    docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
    docker-php-ext-install intl opcache pdo pdo_mysql mbstring gmp gd \
    exif bcmath fileinfo pcntl zip xml && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN echo "alias ll='ls -la'" >> ~/.bashrc

# bash as default shell
SHELL ["/bin/bash", "-c"]

# Set up history for bash
RUN echo "export HISTFILE=~/.bash_history" >> ~/.bashrc && \
    echo "export HISTSIZE=1000" >> ~/.bashrc && \
    echo "export HISTFILESIZE=2000" >> ~/.bashrc


RUN php -r "copy('https://getcomposer.org/download/1.10.22/composer.phar', 'composer.phar');" \
    && chmod +x composer.phar \
    && mv composer.phar /usr/local/bin/composer


