FROM php:8.3-fpm

RUN apt update && apt install -y \
        curl \
        wget \
        git \
        unzip \
        zip \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libonig-dev \
        libpng-dev \
        libwebp-dev \
        libicu-dev \
        libpq-dev \
        libxpm-dev \
        libwebp-dev \
        libvpx-dev \
        libzip-dev \
        libyaml-dev \
        fish \
        postgresql-client \
        ffmpeg \
    && pecl install yaml \
    && docker-php-ext-enable yaml\
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && pecl install redis \
    && docker-php-ext-enable redis

# Configure and install PHP extentions
RUN set -eux; \
    docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-xpm --with-webp; \
    docker-php-ext-configure intl; \
    docker-php-ext-configure zip; \
    docker-php-ext-install -j "$(nproc)" iconv \
        mbstring \
        gd \
        intl \
        sockets \
        zip \
        pgsql \
        opcache \
        pdo_pgsql \
        pcntl \
        exif

RUN chsh -s /usr/bin/fish

COPY --from=spiralscout/roadrunner:2.9.1 /usr/bin/rr /usr/bin/rr

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini

RUN groupadd --gid 1000 user \
    && useradd --uid 1000 --gid 1000 --shell /usr/bin/fish user \
    && mkdir /home/user \
    && chmod 777 /home/user

USER user

WORKDIR /app/skl-test

CMD ["php-fpm"]
