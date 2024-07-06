# Deploy to Shared Hosting

## Requirements
- PHP 8.1+
- SQLite3 extension enabled
- mod_rewrite (Apache)

## Steps

### 1. Upload files
Upload the entire `backend/` directory to your hosting via FTP/File Manager.

### 2. Create database.sqlite
```bash
touch database/database.sqlite
chmod 664 database/database.sqlite
```

### 3. Edit .env
Copy `.env.production` to `.env` and update:
- `APP_URL` — your domain
- `APP_KEY` — generate new one: `php artisan key:generate`
- `DB_DATABASE` — full path to database.sqlite

### 4. Run migrations
```bash
php artisan migrate --force
php artisan db:seed --force
```

### 5. Set permissions
```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod -R 777 storage/logs
```

### 6. Configure .htaccess
The `public/.htaccess` file should handle Laravel routing. If not, create it:

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

### 7. Cron job (optional)
For queues/scheduler:
```bash
* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
```

## File structure on hosting
```
public_html/          (or your domain root)
├── app/
├── bootstrap/
├── config/
├── database/
│   └── database.sqlite
├── public/
│   ├── index.php     ← Point domain to this
│   └── .htaccess
├── resources/
├── routes/
├── storage/
├── .env
└── artisan
```

**IMPORTANT:** Point your domain to the `public/` directory, not the project root!
