<?php

namespace App\Models;

use PDO;

abstract class BaseModel
{
	protected PDO $pdo;

	public function __construct(PDO $pdo)
	{
		$this->pdo = $pdo;
	}

	protected function getUserId(): ?int
	{
		return $_SESSION['userid'] ?? null;
	}
}
