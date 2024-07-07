<?php
/**
 * GCH Installer — run once via browser, then DELETE this file
 * Access: https://yourdomain.com/gch/public/install.php
 */

 chdir(__DIR__ . '/..');

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

echo "<pre>";
echo "=== GCH Installer ===\n\n";

// 1. Generate APP_KEY
echo "1. Generating APP_KEY... ";
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    $env = file_get_contents($envFile);
    if (strpos($env, 'APP_KEY=') !== false && strpos($env, 'APP_KEY=base64:') === false) {
        $key = 'base64:' . base64_encode(random_bytes(32));
        $env = preg_replace('/APP_KEY=.*/', "APP_KEY=$key", $env);
        file_put_contents($envFile, $env);
        echo "DONE\n";
    } else {
        echo "SKIPPED (already set)\n";
    }
} else {
    echo "FAILED (.env not found)\n";
}

// 2. Create SQLite database
echo "2. Creating database.sqlite... ";
$dbPath = __DIR__ . '/../database/database.sqlite';
if (!file_exists($dbPath)) {
    touch($dbPath);
    chmod($dbPath, 0664);
    echo "DONE\n";
} else {
    echo "EXISTS\n";
}

// 3. Run migrations
echo "3. Running migrations...\n";
$status = $kernel->call('migrate', ['--force' => true]);
echo "   Result: " . ($status === 0 ? "SUCCESS" : "FAILED ($status)") . "\n";

// 4. Seed
echo "4. Seeding database...\n";
$status = $kernel->call('db:seed', ['--force' => true]);
echo "   Result: " . ($status === 0 ? "SUCCESS" : "FAILED ($status)") . "\n";

// 5. Set permissions
echo "5. Setting permissions... ";
chmod(__DIR__ . '/../storage', 0755);
chmod(__DIR__ . '/../storage/logs', 0777);
chmod(__DIR__ . '/../bootstrap/cache', 0755);
echo "DONE\n";

echo "\n=== Installation complete! ===\n";
echo "DELETE this file (install.php) for security!\n";
echo "</pre>";
