<?php

echo "Starting ForgePHP Development Server...\n";

// Get host and port from the APP_URL in .env
$urlParts = parse_url($_ENV['APP_URL']);
$host = $urlParts['host'] ?? '127.0.0.1';
$port = $urlParts['port'] ?? 5432;

echo "Server running at http://{$host}:{$port}\n";

// Start PHP built-in server
$documentRoot = $basePath; // Set document root to the project root
$command = "php -S {$host}:{$port} -t {$documentRoot}";
exec($command);
exit;
