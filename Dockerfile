# Use PHP 7.4 FPM image
FROM php:7.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    curl \
    zip \
    unzip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd

# Get Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www

# Copy the application code
COPY ./laravel /var/www

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Change ownership of our applications
RUN chown -R www-data:www-data /var/www

# Expose port 9000
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
