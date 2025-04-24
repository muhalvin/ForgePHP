<?php

use App\Core\Route;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

Route::get('/login', 'AuthController@formlogin', [GuestMiddleware::class]);
Route::post('login', 'AuthController@auth', [GuestMiddleware::class]);

Route::get('/register', 'AuthController@formregister', [GuestMiddleware::class]);
Route::post('register', 'AuthController@register', [GuestMiddleware::class]);

Route::get('/forget-password', 'AuthController@formforget', [GuestMiddleware::class]);
Route::post('/forget', 'AuthController@forget', [GuestMiddleware::class]);

Route::post('logout', 'AuthController@destroy', [AuthMiddleware::class]);
