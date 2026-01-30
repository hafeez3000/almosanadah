FROM php:8.4-fpm-alpine
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN apk update \
&& apk add --no-cache \
curl \
libxml2-dev \
php-soap \
libzip-dev \
unzip \
zip \
libpng \
libpng-dev \
jpeg-dev \
oniguruma-dev \
curl-dev \
postgresql-dev \
libpq-dev \
bash \
supervisor \
postgresql-client \
coreutils \
freetype-dev \
libjpeg-turbo-dev \
libltdl \
libmcrypt-dev \
libpng-dev  \
linux-headers \
&& docker-php-ext-install pdo_pgsql pgsql pdo mbstring exif zip soap bcmath curl opcache sockets posix intl \
&& docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
&& docker-php-ext-install -j$(nproc) gd