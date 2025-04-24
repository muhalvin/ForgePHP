<?php

namespace App\Controllers;

require_once __DIR__ . '/../../config/autoload.php';

class Controller
{
	protected $pdo;

	public function __construct()
	{
		global $pdo;
		$this->pdo = $pdo;
	}

	/**
	 * Redirect ke URL tertentu.
	 *
	 * @param string $url
	 * @return void
	 */
	public function redirect(string $url)
	{
		header("Location: $url");
		exit();
	}

	/**
	 * Membantu untuk memvalidasi dan mensanitasi input.
	 *
	 * @param string $input
	 * @return string
	 */
	public function sanitizeInput(string $input)
	{
		return htmlspecialchars(trim($input));
	}
}
