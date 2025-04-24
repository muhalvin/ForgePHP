<?php

namespace App\Core;

use Symfony\Component\Routing\Route as SymfonyRoute;
use Symfony\Component\Routing\RouteCollection;

class Route
{
	protected static RouteCollection $routes;
	protected static array $middlewares = [];

	public static function init(): void
	{
		self::$routes = new RouteCollection();
	}

	public static function get(string $uri, string|callable $controller, array $middleware = []): void
	{
		self::addRoute(['GET'], $uri, $controller, $middleware);
	}

	public static function post(string $uri, string|callable $controller, array $middleware = []): void
	{
		self::addRoute(['POST'], $uri, $controller, $middleware);
	}

	protected static function addRoute(array $methods, string $uri, string|callable $controller, array $middleware = []): void
	{
		$route = new SymfonyRoute(
			$uri,
			['_controller' => $controller],
			[],
			[],
			'',
			[],
			$methods
		);

		// Generate route name
		$routeName = is_string($controller)
			? $controller . '@' . implode('_', $methods)
			: md5($uri . implode('_', $methods)); // Unique name for closure-based routes

		self::$routes->add($routeName, $route);

		if (!empty($middleware)) {
			self::$middlewares[$routeName] = $middleware;
		}
	}

	public static function getRoutes(): RouteCollection
	{
		return self::$routes;
	}

	public static function handleMiddleware(string $routeName, $request): void
	{
		if (isset(self::$middlewares[$routeName])) {
			foreach (self::$middlewares[$routeName] as $middleware) {
				$middlewareInstance = new $middleware;
				$middlewareInstance->handle($request);
			}
		}
	}
}
