FROM dunglas/frankenphp:latest

RUN install-php-extensions pdo_mysql

COPY . /app
WORKDIR /app

EXPOSE 8080
CMD ["php", "-S", "0.0.0.0:8080", "-t", "."]
