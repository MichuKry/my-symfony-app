FROM php:8.1-fpm

# Zainstaluj zależności systemowe
RUN apt-get update && apt-get install -y \
    unzip \
    iproute2 \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-install pdo_mysql gd \
    && apt-get clean

# Zainstaluj Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

# Ustawienie PHP-FPM na port 9000
RUN echo "listen = 9000" >> /usr/local/etc/php-fpm.d/www.conf
RUN echo "Debug: PHP-FPM configured to listen on 9000" > /proc/1/fd/1

CMD ["php-fpm"]
