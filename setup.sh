#!/bin/bash
# Quick setup script for shared hosting
# Run this via SSH after uploading files

echo "=== GCH Backend Setup ==="

# 1. Create database
touch database/database.sqlite
chmod 664 database/database.sqlite

# 2. Copy .env
if [ ! -f .env ]; then
    cp .env.example .env
    echo "Created .env from .env.example"
    echo "EDIT .env before continuing!"
    exit 1
fi

# 3. Generate app key
php artisan key:generate --force

# 4. Run migrations
php artisan migrate --force

# 5. Seed (optional)
read -p "Run seed? (y/n) " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    php artisan db:seed --force
fi

# 6. Set permissions
chmod -R 755 storage bootstrap/cache
chmod -R 777 storage/logs

echo ""
echo "=== Setup complete! ==="
echo "Make sure your domain points to the 'public/' directory."
