#!/bin/bash
# GCH Quick Setup — run in hosting console
# Usage: bash setup.sh

echo "=== GCH Setup ==="

# 1. Create .env from template
if [ ! -f .env ]; then
    cp .env.production .env
    echo "Created .env from .env.production"
else
    echo ".env already exists"
fi

# 2. Generate APP_KEY
php artisan key:generate --force
echo "APP_KEY generated"

# 3. Create database
touch database/database.sqlite
chmod 664 database/database.sqlite
echo "Database created"

# 4. Run migrations
php artisan migrate --force
echo "Migrations complete"

# 5. Seed
php artisan db:seed --force
echo "Database seeded"

# 6. Set permissions
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod -R 777 storage/logs
echo "Permissions set"

# 7. Create storage link
php artisan storage:link --force
echo "Storage link created"

# 8. Clear cache
php artisan config:clear
php artisan cache:clear
echo "Cache cleared"

echo ""
echo "=== Setup complete! ==="
echo ""
echo "API URL: https://botiques.grigiriy.ru/gch/api/v1/trainings"
echo ""
echo "TODO:"
echo "1. Edit .env and set DB_DATABASE to correct path"
echo "2. Delete public/install.php for security"
echo ""
