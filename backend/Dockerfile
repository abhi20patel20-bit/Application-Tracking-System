FROM php:8.3-cli

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    curl \
    libzip-dev \
    libonig-dev \
    libxml2-dev

RUN docker-php-ext-install \
    pdo \
    pdo_pgsql \
    mbstring \
    zip \
    mbstring \
    bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

ENV COMPOSER_MEMORY_LIMIT=-1

RUN composer install --no-interaction --prefer-dist

CMD php artisan serve --host=0.0.0.0 --port=8000
