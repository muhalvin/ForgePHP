<?php

require_once __DIR__ . '/../config/autoload.php';

// Check if '-y' flag is passed
$autoConfirm = in_array('-y', $argv);

if (!$autoConfirm) {
	echo "⚠️  This will DROP ALL TABLES in the database. Type 'y' to continue: ";
	$handle = fopen("php://stdin", "r");
	$confirmation = trim(fgets($handle));
	fclose($handle);

	if (strtolower($confirmation) !== 'y') {
		echo "Rollback aborted.\n";
		exit;
	}
}

try {
	$pdo->exec("SET FOREIGN_KEY_CHECKS = 0");

	$tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);

	if (empty($tables)) {
		echo "No tables found. Nothing to rollback.\n";
		exit;
	}

	foreach ($tables as $table) {
		$pdo->exec("DROP TABLE IF EXISTS `$table`");
		echo "Dropped table: $table\n";
	}

	$pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

	echo "Rollback completed: all tables dropped.\n";
} catch (PDOException $e) {
	echo "Rollback error: " . $e->getMessage() . "\n";
}
