FROM dunglas/frankenphp:latest

# Installer les extensions MySQL
RUN install-php-extensions pdo_mysql

# Copier les fichiers
COPY . /app

WORKDIR /app

# Lancer FrankenPHP
CMD ["frankenphp", "run", "--config", "/app/Caddyfile"]
