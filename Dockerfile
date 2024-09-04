FROM php:8.1-apache

WORKDIR /var/www/html

COPY config/ ./config

COPY public/ .

RUN chmod -R 775 /var/www/html &&\
    chown -R www-data:www-data /var/www/html


RUN docker-php-ext-install pdo pdo_mysql

EXPOSE 80

CMD ["apache2-foreground"]