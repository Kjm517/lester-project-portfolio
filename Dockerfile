# Use the official PHP 8.2 FPM image as the base
FROM php:8.2-fpm

# Declare build arguments for user and UID
ARG user=appuser
ARG uid=1000

# Update package lists and install necessary system dependencies
RUN apt update && apt install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev

# Clean up to reduce the image size
RUN apt clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions required for the application
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Copy Composer from its official image into this container
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create a new user with specified UID and home directory
RUN useradd -G www-data,root -u $uid -d /home/$user $user && \
    mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set the working directory inside the container
WORKDIR /var/www

# Switch to the newly created user
USER $user
