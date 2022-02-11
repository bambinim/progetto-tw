FROM php:8.0-apache
RUN docker-php-ext-install pdo pdo_mysql
USER root
WORKDIR /var/www/html
COPY ./ ./
RUN mv virtualhost.conf /etc/apache2/sites-available/000-default.conf
RUN chown -R www-data:www-data ./
EXPOSE 80