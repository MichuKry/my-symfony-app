# Używamy lekkiego obrazu PHP
FROM php:8.2-fpm-alpine

# Instalujemy zależności systemowe potrzebne do rozszerzeń PHP
RUN apk add --no-cache \
    git \
    unzip \
    libpq-dev \
    icu-dev

# Instalujemy rozszerzenia PHP: do bazy danych (pdo_pgsql) i inne przydatne w Symfony
RUN docker-php-ext-install \
    pdo \
    pdo_pgsql \
    intl

# Pobieramy Composera (menedżera pakietów PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Ustawiamy katalog roboczy
WORKDIR /var/www/html
