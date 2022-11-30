FROM php:7.4-apache
RUN apt-get update && apt upgrade -y
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli
ADD ./app /var/www/html/waiting
COPY ./app/conf/site.conf /etc/apache2/sites-available/my-site.conf
EXPOSE 80
EXPOSE 443