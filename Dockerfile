FROM php:8.0-apache

# Set working directory
WORKDIR /var/www

# Configs for apache
COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY docker/apache/000-default.conf /etc/apache2/sites-enabled/000-default.conf
COPY docker/apache/ports.conf /etc/apache2/ports.conf

# Configs
RUN apt-get update &&\
    apt-get install -y libpq-dev zip

# Add PHP extensions
RUN docker-php-ext-install pdo_pgsql

# Add Apache2 mods
RUN a2enmod rewrite

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Install app
COPY src /var/www
RUN composer install

CMD chown -R www-data:www-data /var/www/storage &&\
    chown -R www-data:www-data /var/www/bootstrap/cache &&\
    php artisan config:cache &&\
    php artisan route:cache &&\
    php artisan view:cache &&\
    apache2-foreground
