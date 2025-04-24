#!/usr/bin/env php
<?php

$timestamp = date('Ymd_His');
$migrationName = $argv[2] . 's' ?? null;

if (!$migrationName) {
	echo "Error: Migration name is required.\n";
	exit(1);
}

$filename = "{$timestamp}_create_{$migrationName}_table.php";
$directory = __DIR__ . '/../database/migrations';
$filepath = $directory . '/' . $filename;

if (!is_dir($directory)) {
	mkdir($directory, 0777, true);
}

$template = <<<PHP
<?php

return function (\$pdo) {
    \$tableName = '$migrationName';

    \$query = \$pdo->query("SHOW TABLES LIKE '\$tableName'");
    if (\$query->rowCount() > 0) {
        echo "Migration skipped: \$tableName table already exists";
        return;
    }

    \$pdo->exec("
        CREATE TABLE IF NOT EXISTS \$tableName (
            `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");
};
PHP;

file_put_contents($filepath, $template);

echo "Migration created: $filename\n";
