<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/autoload.php';

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpFoundation\Request;
use App\Core\Route;
use App\Core\Session;

Session::start();

// Create request context
$request = Request::createFromGlobals();
$context = new RequestContext();
$context->fromRequest($request);
$context->setBaseUrl($_ENV['APP_URL'] ?? '');

// Load defined routes
$routes = require __DIR__ . '/routes/web.php';
if (!$routes instanceof Symfony\Component\Routing\RouteCollection) {
	die('Error: Routes not loaded correctly.');
}

$matcher = new UrlMatcher($routes, $context);

$parameters = $matcher->match($request->getPathInfo());

// Handle middleware
Route::handleMiddleware($parameters['_route'], $request);

// Resolve controller
$controller = $parameters['_controller'];
unset($parameters['_controller'], $parameters['_route']);

if (is_callable($controller)) {
	$response = call_user_func_array($controller, $parameters);
} else {
	list($class, $method) = explode('@', $controller);
	$className = 'App\\Controllers\\' . $class;

	if (!class_exists($className)) {
		throw new Exception("Controller class {$className} not found.");
	}

	$instance = new $className;
	$response = call_user_func_array([$instance, $method], $parameters);
}

if (is_string($response)) {
	echo $response;
}
