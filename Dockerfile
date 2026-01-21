FROM php:8.2-apache
RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli

# Estas líneas fuerzan el límite a 50MB directamente en la configuración de PHP
RUN echo "upload_max_filesize = 50M" > /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size = 50M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "memory_limit = 256M" >> /usr/local/etc/php/conf.d/uploads.ini

RUN chown -R www-data:www-data /var/www/html
