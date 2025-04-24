<?php

namespace App\Core\Session;

use App\Core\Session;
use App\Core\SessionStorageInterface;
use PDO;

class DatabaseSessionStorage implements SessionStorageInterface
{
	protected PDO $pdo;

	public function __construct()
	{
		global $pdo;
		$this->pdo = $pdo;
	}

	public function start()
	{
		if (session_status() === PHP_SESSION_NONE) {
			session_set_save_handler(
				[$this, 'open'],
				[$this, 'close'],
				[$this, 'read'],
				[$this, 'write'],
				[$this, 'destroy'],
				[$this, 'gc']
			);
		}
	}

	public function open($savePath, $sessionName)
	{
		return true;
	}
	public function close()
	{
		return true;
	}

	public function read($id)
	{
		$stmt = $this->pdo->prepare("SELECT payload, ip_address, user_agent, last_activity FROM sessions WHERE id = :id LIMIT 1");
		$stmt->execute(['id' => $id]);
		$session = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($session) {
			// Get session lifetime (default to 1 minute if not set)
			$sessionLifetime = isset($_ENV['SESSION_LIFETIME']) ? (int)$_ENV['SESSION_LIFETIME'] : 30;

			if (time() - $session['last_activity'] > ($sessionLifetime * 60)) {
				$this->destroy($id);
				return '';
			}

			// Security check (IP & User Agent)
			if ($session['ip_address'] !== $_SERVER['REMOTE_ADDR'] || $session['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
				$this->destroy($id);
				return '';
			}

			return unserialize($session['payload']);
		}
		return '';
	}

	public function write($id, $data)
	{
		$time = time();

		$userId = $_SESSION['user_id'] ?? null;
		$ip = $_SERVER['REMOTE_ADDR'] ?? null;
		$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? null;

		$stmt = $this->pdo->prepare("
			REPLACE INTO sessions (id, user_id, ip_address, user_agent, payload, last_activity)
			VALUES (:id, :user_id, :ip_address, :user_agent, :payload, :last_activity)
		");

		return $stmt->execute([
			'id' => $id,
			'user_id' => $userId,
			'ip_address' => $ip,
			'user_agent' => $userAgent,
			'payload' => serialize($data),
			'last_activity' => $time
		]);
	}

	public function destroy($id)
	{
		$stmt = $this->pdo->prepare("DELETE FROM sessions WHERE id = :id");
		return $stmt->execute(['id' => $id]);
	}

	public function gc($maxLifetime)
	{
		$expire = time() - $maxLifetime;
		$stmt = $this->pdo->prepare("DELETE FROM sessions WHERE last_activity < :expire");
		return $stmt->execute(['expire' => $expire]);
	}

	public function get(string $key)
	{
		$data = $this->read(session_id());
		if (!$data || !$this->isSerialized($data)) return null;

		$sessionData = unserialize($data);
		return $sessionData[$key] ?? null;
	}

	private function isSerialized($data)
	{
		return is_string($data) && preg_match('/^(a|O|s|i|d|b|N):/', $data);
	}

	public function set(string $key, $value)
	{
		$data = $this->read(session_id());
		$sessionData = $data ? unserialize($data) : [];
		$sessionData[$key] = $value;

		return $this->write(session_id(), serialize($sessionData));
	}

	public function forget(string $key)
	{
		$data = $this->read(session_id());
		if (!$data) return false;

		$sessionData = unserialize($data);
		unset($sessionData[$key]);

		return $this->write(session_id(), serialize($sessionData));
	}
}
