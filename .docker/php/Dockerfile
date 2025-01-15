FROM php:8.3-fpm-alpine

ARG TIMEZONE

COPY php.ini /usr/local/etc/php/conf.d/docker-php-config.ini

RUN apk update && apk add --no-cache \
    gnupg \
    g++ \
    procps \
    openssl \
    git \
    unzip \
    zlib-dev \
    libzip-dev \
    freetype-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    icu-dev \
    oniguruma-dev \
    libxslt-dev \
    acl \
    bash \
    nodejs \
    npm \
    autoconf

RUN docker-php-ext-configure gd --with-jpeg --with-freetype

RUN docker-php-ext-install \
    pdo pdo_mysql zip xsl gd intl opcache exif mbstring

# Set timezone
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone \
    && printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini \
    && "date"

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add xdebug
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS
RUN apk add --update linux-headers
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
RUN apk del -f .build-deps

# Create xdebug log directory
RUN mkdir -p /var/www/html/xdebug && chmod -R 777 /var/www/html/xdebug

# Configure Xdebug
RUN echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "display_errors=On" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "display_startup_errors=On" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "html_errors=On" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.log=/var/www/html/xdebug/xdebug.log" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.discover_client_host=1" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_port=9000" >> /usr/local/etc/php/conf.d/xdebug.ini

RUN npm install -g yarn

WORKDIR /var/www/filmoteca
