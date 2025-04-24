<?php

namespace App\Middleware;

class AuthMiddleware
{
	public function handle($request)
	{
		if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
			header('Location: ' . base_url('/'));
			exit();
		}
	}
}
