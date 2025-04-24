<?php

namespace App\Core\Session;

use App\Core\SessionStorageInterface;

class FileSessionStorage implements SessionStorageInterface
{
	protected $config;

	public function __construct()
	{
		$this->config = require __DIR__ . '/../../../config/session.php';
	}

	public function start()
	{
		if (session_status() === PHP_SESSION_NONE) {
			session_name($this->config['name']);
			session_set_cookie_params(
				$this->config['lifetime'] * 60, // Convert minutes to seconds
				'/',
				'',
				$this->config['secure'],
				$this->config['httponly']
			);
			session_start();

			// Pengecekan session expired manual
			$this->checkExpired();
		}
	}

	public function get(string $key)
	{
		$this->checkExpired(); // Pastikan pengecekan setiap kali akses data
		return $_SESSION[$key] ?? null;
	}

	public function set(string $key, $value)
	{
		$_SESSION[$key] = $value;
		$_SESSION['last_activity'] = time(); // Update waktu aktivitas terakhir
	}

	public function forget(string $key)
	{
		unset($_SESSION[$key]);
	}

	public function destroy($id = null)
	{
		$_SESSION = [];
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(
				session_name(),
				'',
				time() - 42000,
				$params['path'],
				$params['domain'],
				$params['secure'],
				$params['httponly']
			);
		}
		session_destroy();
	}

	/**
	 * Cek apakah session sudah expired berdasarkan last_activity
	 */
	protected function checkExpired()
	{
		if (isset($_SESSION['last_activity'])) {
			$sessionLifetime = $this->config['lifetime'] * 60; // Dalam detik
			if (time() - $_SESSION['last_activity'] > $sessionLifetime) {
				$this->destroy(); // Hapus session jika expired
			}
		} else {
			$_SESSION['last_activity'] = time(); // Set awal jika belum ada
		}
	}
}
