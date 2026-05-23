FROM php:8.4-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libjpeg-dev libfreetype6-dev \
    libzip-dev libxml2-dev libonig-dev libcurl4-openssl-dev \
    nodejs npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring xml bcmath gd zip curl pcntl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy everything first
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies and build frontend
RUN npm ci && npm run build

# Create storage directories and set permissions
RUN mkdir -p storage/framework/{sessions,views,cache} \
    && mkdir -p storage/logs \
    && mkdir -p bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE ${PORT:-8080}

# Production defaults for Railway
ENV LOG_CHANNEL=stderr \
    LOG_LEVEL=error \
    CACHE_STORE=file \
    SESSION_DRIVER=cookie

# Startup: migrate first, then seed, then cache config and serve
CMD ["sh", "-c", "echo '=== Starting App ===' && echo \"DB_HOST=${DB_HOST:-not set}\" && echo \"DB_DATABASE=${DB_DATABASE:-not set}\" && php artisan migrate --force && php artisan db:seed --force && php artisan config:cache && php artisan route:cache && php artisan view:cache && (php artisan storage:link 2>/dev/null || true) && echo '=== Server Starting ===' && php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"]
