<?php

require_once __DIR__ . '/../vendor/autoload.php';

$files = [
	__DIR__ . '/bootstrap.php',
	__DIR__ . '/view.php',
	__DIR__ . '/config.php',
	__DIR__ . '/database.php',
	__DIR__ . '/log.php',
	__DIR__ . '/cache.php',
];

foreach ($files as $file) {
	if (file_exists($file)) {
		require_once $file;
	} else {
		$errorMessage = "Configuration file not found: $file at " . date('Y-m-d H:i:s');
		error_log($errorMessage, 3, __DIR__ . '/../error.log');

		// Output error message to user
		echo "Error: Missing required configuration file. Please check the logs.";
		exit;
	}
}
