<?php
require_once __DIR__ . '/../config/autoload.php';

use App\Core\Route;

Route::init();
require __DIR__ . '/auth.php';

Route::get('/', function () {
	return view('welcome');
});



// This will return the defined routes. Ensure it's placed at the end of the code block.
return Route::getRoutes();
