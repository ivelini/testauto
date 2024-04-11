FROM php:8.2-fpm

# Install main dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    ffmpeg libsm6 libxext6 \
    libicu-dev \
    libmcrypt-dev \
    zlib1g-dev \
    libxml2-dev \
    libonig-dev \
    libpq-dev \
    libcurl4-openssl-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev \
    libfreetype6 libfreetype6-dev \
    locales \
    pkg-config \
    libzip-dev zip unzip\
    git \
    curl \
    wget \
    gnupg \
    htop

# Configure php extensions
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp

# Install php extensions
RUN docker-php-ext-install \
    gd \
    bcmath \
    calendar \
    curl \
    exif \
    iconv \
    intl \
    mbstring \
    opcache \
    pdo \
    pdo_mysql \
    pcntl \
    xml \
    zip

RUN pecl install redis && docker-php-ext-enable redis

# Copy php.ini configurations
COPY php.ini /usr/local/etc/php/conf.d/40-custom.ini
COPY opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

# Cleanup dev dependencies
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && docker-php-source delete

# Set working directory
WORKDIR /var/www

ARG USER_ID
ARG GROUP_ID

USER root

RUN usermod -u ${USER_ID} www-data && groupmod -g ${GROUP_ID} www-data

USER www-data

EXPOSE 9000

# The main purpose of a CMD is to provide defaults for an executing container. These defaults can include an executable,
# or they can omit the executable, in which case you must specify an ENTRYPOINT instruction as well.
CMD php-fpm
