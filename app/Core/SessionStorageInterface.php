<?php

namespace App\Core;

interface SessionStorageInterface
{
	public function start();
	public function get(string $key);
	public function set(string $key, $value);
	public function forget(string $key);
	public function destroy($id);
}
