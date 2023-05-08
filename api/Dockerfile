#######################################################################
#            Laravel/Lumen 8 Application - Dockerfile v0.5          #
#######################################################################

#------------- Setup Environment -------------------------------------------------------------

# Pull base image
FROM ubuntu:18.04

# Install common tools
RUN apt-get update
RUN apt-get install -y wget curl nano htop git unzip bzip2 software-properties-common locales

# Set evn var to enable xterm terminal
ENV TERM=xterm

# Set timezone to UTC to avoid tzdata interactive mode during build
ENV TZ=America/Mexico_City
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Set working directory
WORKDIR /var/www/html/api/

# Set up locales
# RUN locale-gen

#------------- Application Specific Stuff ----------------------------------------------------

# Install PHP
RUN LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php
RUN apt update
RUN apt-get install -y \
    php7.4-fpm \
    php7.4-common \
    php7.4-curl \
    php7.4-mysql \
    php7.4-mbstring \
    php7.4-json \
    php7.4-xml \
    php7.4-bcmath \
    php7.4-gd \
    php7.4-mysql \
    php7.4-pgsql \
    php-pgsql

# Config fpm to use TCP instead of unix socket
ADD docker/php/www.conf /etc/php/7.4/fpm/pool.d/www.conf
RUN mkdir -p /var/run/php

# Install Nginx
RUN apt-key adv --keyserver keyserver.ubuntu.com --recv-keys ABF5BD827BD9BF62
RUN apt-key adv --keyserver keyserver.ubuntu.com --recv-keys 4F4EA0AAE5267A6C
RUN echo "deb http://nginx.org/packages/ubuntu/ trusty nginx" >> /etc/apt/sources.list
RUN echo "deb-src http://nginx.org/packages/ubuntu/ trusty nginx" >> /etc/apt/sources.list
RUN apt-get update

RUN apt-get install -y nginx

ADD docker/nginx/default /etc/nginx/sites-enabled/
ADD docker/nginx/nginx.conf /etc/nginx/

#------------- Composer & laravel configuration ----------------------------------------------------

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#------------- Supervisor Process Manager ----------------------------------------------------

# Install supervisor
RUN apt-get install -y supervisor
RUN mkdir -p /var/log/supervisor
ADD docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

#------------- Container Config ---------------------------------------------------------------

#------------- After all give permisions --------------#

RUN chgrp -R www-data /var/www
RUN chmod -R g+w /var/www
RUN find /var/www -type d -exec chmod 2775 {} \;
RUN find /var/www -type f -exec chmod ug+rw {} \;

#------- Composer dependecies ---------------------#
COPY . .
RUN composer install
#------- Composer dependecies ---------------------#

RUN chown www-data: -R /var/www/html

# Expose port 80
EXPOSE 80

# Set supervisor to manage container processes
ENTRYPOINT ["/usr/bin/supervisord"]