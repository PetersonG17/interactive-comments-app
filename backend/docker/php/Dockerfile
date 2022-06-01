FROM php:8.1-fpm

# Update the apt-get
RUN apt-get update && apt-get install -y \
    # Node and NPM
    nodejs \
    npm \
    # Needed for php zip extension
    libzip-dev \
    zip \
    # Needed for php intl extension
    libicu-dev \
    g++ \
    libpq-dev

# install php extensions
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql pcntl intl zip

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Default working directory
WORKDIR /var/www/app/

# Copy the source code
COPY ./backend/src .

RUN composer install

# Default command when server starts
CMD ["php-fpm"]
