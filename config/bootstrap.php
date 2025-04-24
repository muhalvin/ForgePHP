<?php

require_once __DIR__ . '/../App/Core/ErrorHandler.php';

use App\Core\ErrorHandler;
use Dotenv\Dotenv;
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

if ($_ENV['APP_ENV'] === 'local' && $_ENV['APP_DEBUG'] === 'true') {
	ini_set('display_errors', 1);
	error_reporting(E_ALL);

	$whoops = new Run;
	$handler = new \Whoops\Handler\PrettyPageHandler;

	// Hides sensitive superglobals
	$handler->blacklist('_ENV', 'APP_KEY');
	$handler->blacklist('_ENV', 'DB_CONNECTION');
	$handler->blacklist('_ENV', 'DB_HOST');
	$handler->blacklist('_ENV', 'DB_PORT');
	$handler->blacklist('_ENV', 'DB_DATABASE');
	$handler->blacklist('_ENV', 'DB_USERNAME');
	$handler->blacklist('_ENV', 'DB_PASSWORD');

	$handler->blacklist('_SERVER', 'APP_KEY');
	$handler->blacklist('_SERVER', 'DB_CONNECTION');
	$handler->blacklist('_SERVER', 'DB_HOST');
	$handler->blacklist('_SERVER', 'DB_PORT');
	$handler->blacklist('_SERVER', 'DB_DATABASE');
	$handler->blacklist('_SERVER', 'DB_USERNAME');
	$handler->blacklist('_SERVER', 'DB_PASSWORD');

	$whoops->pushHandler($handler);
	$whoops->register();
} else {
	ini_set('display_errors', 0);
	error_reporting(0);

	set_exception_handler(function ($e) {
		error_log($e);

		if ($e instanceof ResourceNotFoundException) {
			ErrorHandler::handle(404);
		} elseif ($e instanceof AccessDeniedHttpException) {
			ErrorHandler::handle(403);
		} else {
			ErrorHandler::handle(500);
		}
	});
}
