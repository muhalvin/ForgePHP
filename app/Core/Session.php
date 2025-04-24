<?php

namespace App\Core;

use App\Core\Session\FileSessionStorage;
use App\Core\Session\DatabaseSessionStorage;

class Session
{
	protected static SessionStorageInterface $driver;

	public static function start()
	{
		$config = require __DIR__ . '/../../config/session.php';

		switch ($config['driver']) {
			case 'file':
				self::$driver = new FileSessionStorage();
				break;
			case 'database':
				self::$driver = new DatabaseSessionStorage();
				break;
			default:
				throw new \Exception("Unsupported session driver: " . $config['driver']);
		}

		// Set session name (optional, from config)
		session_name($config['name']);

		// Register handler before session_start
		self::$driver->start();

		if (session_status() === PHP_SESSION_NONE) {
			session_start();
		}
	}

	public static function get(string $key)
	{
		return self::$driver->get($key);
	}

	public static function set(string $key, $value)
	{
		self::$driver->set($key, $value);
	}

	public static function forget(string $key)
	{
		self::$driver->forget($key);
	}

	public static function destroy($id)
	{
		self::$driver->destroy($id);
	}

	public static function setUserId($userId)
	{
		self::set('user_id', $userId);
	}

	public static function getUserId()
	{
		return self::get('user_id');
	}
}
