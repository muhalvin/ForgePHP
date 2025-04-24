<?php

require_once __DIR__ . '/../config/autoload.php';

$migrationsPath = __DIR__ . '/../database/migrations';
$migrationFiles = glob($migrationsPath . '/*.php');

foreach ($migrationFiles as $file) {
	$migration = require $file;
	if (is_callable($migration)) {
		try {
			$migration($pdo);
		} catch (PDOException $e) {
			echo "Migration error [$file]: " . $e->getMessage() . "\n";
		}
	}
}
