<?php

return function ($pdo) {
	$query = $pdo->query("SHOW TABLES LIKE 'users'");
	if ($query->rowCount() > 0) {
		echo "Migration skipped: users table already exists\n";
		return;
	}

	$pdo->exec("
        CREATE TABLE IF NOT EXISTS users (
            `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            `email` VARCHAR(255) NOT NULL UNIQUE,
            `username` VARCHAR(255) NOT NULL UNIQUE,
            `name` VARCHAR(255) NOT NULL,
            `email_verified_at` TIMESTAMP NULL,
            `password` VARCHAR(255) NOT NULL,
            `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");

	echo "Migrated: create_users_table\n";
};
