#!/usr/bin/env bash

# Create the local .env from the template on first run (.env is never committed)
if [ ! -f .env ]; then
    cp .env.example .env
fi

docker-compose up --detach --build

# Install dependencies
docker-compose exec app composer install --ignore-platform-reqs --no-ansi --no-interaction --no-scripts --no-suggest --no-progress --prefer-dist

# Generate a unique APP_KEY for this installation if none is set
if ! grep -q '^APP_KEY=base64:' .env; then
    docker-compose exec app php artisan key:generate --force
fi

# Set correct permissions
docker-compose exec app chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
docker-compose exec app chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Create symlink for storage
docker-compose exec app php artisan storage:link

# Run migrations and seed database
docker-compose exec app php artisan migrate:fresh --seed --force

# Start queue worker
docker-compose exec -d app php artisan queue:work
