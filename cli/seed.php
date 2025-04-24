<?php

require_once __DIR__ . '/../config/autoload.php';

$seedersPath = __DIR__ . '/../database/seeders';
$seederFiles = glob($seedersPath . '/*.php');

foreach ($seederFiles as $file) {
	$seeder = require $file;
	if (is_callable($seeder)) {
		try {
			$seeder($pdo);
		} catch (PDOException $e) {
			echo "Seeder error [$file]: " . $e->getMessage() . "\n";
		}
	}
}
