# Use the official PHP image from Docker Hub
FROM php:8.0-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory in the container
WORKDIR /var/www

# Copy the composer.json and composer.lock files
COPY composer.json composer.lock ./

# Install the dependencies (without dev dependencies)
RUN composer install --no-dev --optimize-autoloader

# Copy the rest of the project files
COPY . .

# Expose the port your app runs on (adjust if necessary)
EXPOSE 80

# Command to run your application (replace this with your actual start command)
CMD ["php-fpm"]
