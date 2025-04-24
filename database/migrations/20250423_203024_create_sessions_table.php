<?php

return function ($pdo) {
	$tableName = 'sessions';

	$query = $pdo->query("SHOW TABLES LIKE '$tableName'");
	if ($query->rowCount() > 0) {
		echo "Migration skipped: $tableName table already exists";
		return;
	}

	$pdo->exec("
        CREATE TABLE IF NOT EXISTS $tableName (
            `id` VARCHAR(255) NOT NULL PRIMARY KEY,
			`user_id` BIGINT UNSIGNED NULL,
			`ip_address` VARCHAR(45) NULL,
			`user_agent` TEXT NULL,
			`payload` TEXT NOT NULL,
			`last_activity` INT NOT NULL,
            `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

			INDEX `sessions_user_id_index` (`user_id`),
			INDEX `sessions_last_activity_index` (`last_activity`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");

	echo "Migrated: create_users_table\n";
};
