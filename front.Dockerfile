FROM php:8.0.7-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql
