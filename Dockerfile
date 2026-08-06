FROM php:8.2-cli

# Install system dependencies & PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libsqlite3-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    sqlite3 \
    && docker-php-ext-install pdo pdo_sqlite pdo_mysql bcmath mbstring gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js (v20)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

WORKDIR /var/www/html

# Copy application files
COPY . .

# Ensure storage & bootstrap permissions and entrypoint execution script
RUN chmod +x /var/www/html/docker-entrypoint.sh

EXPOSE 8000

ENTRYPOINT ["/var/www/html/docker-entrypoint.sh"]
