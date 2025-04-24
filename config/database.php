<?php

// Retrieve the database credentials from the environment variables
$dsn = "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_DATABASE'] . ";charset=utf8mb4";
$db_user = $_ENV['DB_USERNAME'];
$db_pass = $_ENV['DB_PASSWORD'];

try {
	// Create a new PDO instance for the database connection
	$pdo = new PDO($dsn, $db_user, $db_pass, [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	]);
} catch (PDOException $e) {
	// Handle database connection errors
	error_log("Database connection failed: " . $e->getMessage());
	die("Error: Could not connect to the database. Please check the logs.");
}
