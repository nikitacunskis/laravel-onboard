FROM php:8.2-cli
WORKDIR /app
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && docker-php-ext-install pdo_mysql
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
EXPOSE 9001
CMD ["tail", "-f", "/dev/null"]