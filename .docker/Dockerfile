FROM php:7.2-apache

COPY . /srv/price_history
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /srv/price_history

RUN a2enmod rewrite \ 
    && docker-php-ext-install mbstring pdo pdo_mysql \ 
    && chown -R www-data:www-data /srv/price_history