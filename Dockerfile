FROM php:8.3-cli

# Installer les extensions MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Copier les fichiers
WORKDIR /app
COPY . .

# Lancer le serveur PHP intégré
CMD php -S 0.0.0.0:$PORT -t .
