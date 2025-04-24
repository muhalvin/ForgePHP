<?php

namespace App\Core;

class ErrorHandler
{
	public static function handle(int $code): void
	{
		http_response_code($code);

		// Load view rendering functions
		require_once __DIR__ . '/../../config/view.php';

		switch ($code) {
			case 403:
				echo render('errors.403');
				break;
			case 404:
				echo render('errors.404');
				break;
			case 500:
			default:
				echo render('errors.500');
				break;
		}

		exit;
	}
}
