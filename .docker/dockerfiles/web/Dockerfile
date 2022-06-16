FROM php:8.1-apache

ENV COMPOSER_ALLOW_SUPERUSER=1

ARG USER_ID
ARG GROUP_ID

EXPOSE 80
WORKDIR /app

RUN apt-get update

RUN apt-get install -y \
        zlib1g-dev \
        libicu-dev \
        git-core \
        libxrender1 \
        libfontconfig1 \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libzip-dev \
        graphviz

RUN if [ ${USER_ID:-0} -ne 0 ] && [ ${GROUP_ID:-0} -ne 0 ]; then \
    userdel -f www-data &&\
    if getent group www-data ; then groupdel www-data; fi &&\
    groupadd -g ${GROUP_ID} www-data &&\
    useradd -l -u ${USER_ID} -g www-data www-data &&\
    install -d -m 0755 -o www-data -g www-data /home/www-data &&\
    chown --changes --silent --no-dereference --recursive --from=33:33 ${USER_ID}:${GROUP_ID} \
        /home/www-data \
;fi

RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN pecl install apcu xdebug

RUN docker-php-ext-configure gd --enable-gd --with-jpeg --with-freetype
RUN docker-php-ext-install pdo pdo_mysql zip gd intl opcache
RUN docker-php-ext-enable apcu xdebug

COPY errors /errors
COPY conf/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY conf/apache.conf /etc/apache2/conf-available/app.conf
COPY conf/php.ini /usr/local/etc/php/conf.d/app.ini

RUN a2enmod rewrite remoteip && a2enconf app

USER www-data

COPY --from=composer:2.3.7 /usr/bin/composer /usr/local/bin/composer
