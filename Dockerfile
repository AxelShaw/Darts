FROM php:8.3-apache

# Installer les extensions MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Copier les fichiers
COPY . /var/www/html/

# Activer mod_rewrite (optionnel)
RUN a2enmod rewrite

# Port
EXPOSE 80
