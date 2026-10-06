ARG PHP_VERSION=8.5

FROM php:${PHP_VERSION}-apache

RUN docker-php-ext-install pdo pdo_mysql

RUN a2enmod rewrite

COPY . /var/www/html/

# Ensure ssl directory has correct permissions
RUN if [ -d /var/www/html/ssl ]; then chmod 644 /var/www/html/ssl/*.pem 2>/dev/null || true; fi

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN echo "DocumentRoot /var/www/html/public" > /etc/apache2/sites-available/000-default.conf \
    && echo "<Directory /var/www/html/public>" >> /etc/apache2/sites-available/000-default.conf \
    && echo "    AllowOverride All" >> /etc/apache2/sites-available/000-default.conf \
    && echo "    Require all granted" >> /etc/apache2/sites-available/000-default.conf \
    && echo "</Directory>" >> /etc/apache2/sites-available/000-default.conf

EXPOSE 80
