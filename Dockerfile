# Use PHP + Apache official image
FROM php:7.4-apache

# Install MySQL extension for PHP
RUN docker-php-ext-install mysqli

# Copy project files to the container
COPY . /var/www/html/

# Expose port 80
EXPOSE 80