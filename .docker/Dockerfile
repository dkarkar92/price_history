FROM php:7.2-apache

COPY . /srv/price_history
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /srv/price_history

RUN a2enmod rewrite \ 
    && apt-get update && apt-get install -y zlib1g-dev \
    && docker-php-ext-install mbstring pdo pdo_mysql zip \ 
    && chown -R www-data:www-data /srv/price_history

# Install git
RUN apt-get update \
    && apt-get -y install git \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install nodejs
RUN curl -sL https://deb.nodesource.com/setup_10.x -o nodesource_setup.sh && bash nodesource_setup.sh && apt-get -y --force-yes install nodejs
