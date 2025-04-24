<?php

return function ($pdo) {
	$check = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
	if ($check > 0) {
		echo "Seed skipped: users table already has data\n";
		return;
	}

	$stmt = $pdo->prepare("
		INSERT INTO users (email, username, name, password, email_verified_at, created_at, updated_at)
		VALUES (:email, :username, :name, :password, NOW(), NOW(), NOW())
	");

	$users = [
		[
			'email'    => 'admin@forgephp.com',
			'username' => 'forgephp',
			'name'     => 'Muhalvin',
			'password' => password_hash('admin@forgephp.com', PASSWORD_BCRYPT),
		],
	];

	foreach ($users as $user) {
		$stmt->execute($user);
	}

	echo "Seeded: UsersTableSeeder\n";
};
