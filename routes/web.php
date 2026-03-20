<?php

use Src\Route;
Route::add('GET', '/', [Controller\Site::class, 'index']);
Route::add('GET', '/hello', [Controller\Site::class, 'hello']);
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout'])->middleware('auth');
Route::add('GET', '/profile_user', [Controller\UserController::class, 'profile'])->middleware('auth');
Route::add(['GET', 'POST'], '/admin_signup', [Controller\AdminController::class, 'admin_signup'])->middleware('auth', 'admin');
Route::add('GET', '/all_users', [Controller\AdminController::class, 'all_users'])->middleware('auth', 'admin');
Route::add('GET', '/admin_panel', [Controller\AdminController::class, 'admin_panel'])->middleware('auth', 'admin');