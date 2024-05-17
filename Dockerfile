FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libssl-dev \
    zlib1g-dev \
    ca-certificates \
    libxml2-dev \
    && rm -rf /var/lib/apt/lists/*

RUN apt-get update && apt-get install -y \
libfreetype6-dev \
libjpeg62-turbo-dev \
libpng-dev \
libwebp-dev \
libxslt1-dev \
&& docker-php-ext-install -j$(nproc) iconv \
&& docker-php-ext-configure gd --with-freetype --with-webp --with-jpeg \
&& docker-php-ext-install -j$(nproc) gd \
&& docker-php-ext-install pdo pdo_mysql \
&& docker-php-ext-install pcntl posix \
&& docker-php-ext-install xsl \
&& docker-php-ext-install xml \
&& apt-get install -y zlib1g-dev libicu-dev g++ \
&& docker-php-ext-configure intl \
&& docker-php-ext-install intl \
&& apt-get install -y zip unzip \
&& apt-get install -y git \
&& apt-get install -y nano \
&& pecl install -f xdebug \
&& docker-php-ext-enable xdebug

RUN apt-get install librabbitmq-dev -y
RUN pecl install amqp
RUN docker-php-ext-enable amqp

RUN touch /tmp/xdebug.log && chmod 777 /tmp/xdebug.log

RUN curl -sS https://getcomposer.org/installer | \
php -- --install-dir=/usr/bin/ --filename=composer

RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
RUN apt install symfony-cli
RUN cd /usr/local/etc/php && cp php.ini-development php.ini
