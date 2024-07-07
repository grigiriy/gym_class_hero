# Deploy to Shared Hosting

## Requirements
- PHP 8.1+
- SQLite3 extension enabled
- mod_rewrite (Apache)

## Steps

### 1. Upload files
Upload the entire `backend/` contents to `~/botiques.grigiriy/gch/` via FTP/File Manager.

### 2. Create .env
Copy `.env.production` to `.env` and update:
- `DB_DATABASE` — full path to database.sqlite (ask hosting support if unsure)
- `APP_KEY` — run `php artisan key:generate` in console

### 3. Create database
```bash
touch database/database.sqlite
chmod 664 database/database.sqlite
```

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

### 6. Create storage link
```bash
php artisan storage:link
```

### 7. Delete install.php
```bash
rm public/install.php
```

## File structure on hosting
```
gch/                      ← your domain root (or subfolder)
├── .htaccess             ← redirects to public/
├── index.php             ← fallback redirect
├── app/
├── bootstrap/
├── config/
├── database/
│   ├── database.sqlite
│   └── migrations/
├── public/
│   ├── .htaccess         ← Laravel routing
│   ├── index.php         ← Laravel entry point
│   └── storage → ../storage/app/public
├── resources/
├── routes/
├── storage/
├── vendor/
├── .env
└── artisan
```

## API URL
Backend is accessible at: `https://botiques.grigiriy.ru/gch/api/v1/trainings`

## Troubleshooting

### "Not Found" or 403
- Check that `.htaccess` exists in `gch/` root (not just `public/`)
- Check `AllowOverride All` in Apache config (ask hosting support)

### "500 Server Error"
- Check `storage/logs/laravel.log` for errors
- Run `php artisan config:clear` and `php artisan cache:clear`

### "Class not found" or autoload errors
- Run `composer dump-autoload` (if composer available on hosting)
- Or re-upload the `vendor/` directory

### Database errors
- Check `DB_DATABASE` path in `.env` is correct absolute path
- Run `php artisan migrate --force` again
