<?php

use Src\Route;
Route::add('GET', '/', [Controller\Site::class, 'index']);
Route::add('GET', '/hello', [Controller\Site::class, 'hello']);
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout'])->middleware('auth');
Route::add('GET', '/profile_user', [Controller\UserController::class, 'profile'])->middleware('auth');
Route::add(['GET', 'POST'], '/profile_edit', [Controller\UserController::class, 'profile_edit'])->middleware('auth');
Route::add(['GET', 'POST'], '/profile_update', [Controller\UserController::class, 'profile_update'])->middleware('auth');

// Маршруты для администратора
Route::add(['GET', 'POST'], '/admin_signup', [Controller\AdminController::class, 'admin_signup_user'])->middleware('auth', 'admin');
Route::add('GET', '/all_users', [Controller\AdminController::class, 'all_users'])->middleware('auth', 'admin');
Route::add('GET', '/admin_panel', [Controller\AdminController::class, 'admin_panel'])->middleware('auth', 'admin');

// Маршруты для работы со зданиями
Route::add(['GET', 'POST'], '/building_create', [Controller\AdminController::class, 'building_create'])->middleware('auth', 'admin');
Route::add('GET', '/list_buildings', [Controller\AdminController::class, 'list_buildings'])->middleware('auth', 'admin');
Route::add(['GET', 'POST'], '/building_edit', [Controller\AdminController::class, 'building_edit'])->middleware('auth', 'admin');
Route::add(['GET', 'POST'], '/building_update', [Controller\AdminController::class, 'building_update'])->middleware('auth', 'admin');
Route::add(['GET', 'POST'], '/delete_building', [Controller\AdminController::class, 'delete_building'])->middleware('auth', 'admin');

// Маршруты для работы с комнатами
Route::add(['GET', 'POST'], '/room_create', [Controller\AdminController::class, 'room_create'])->middleware('auth', 'admin');
Route::add('GET', '/list_rooms', [Controller\AdminController::class, 'list_rooms'])->middleware('auth', 'admin');
Route::add(['GET', 'POST'], '/delete_room', [Controller\AdminController::class, 'delete_room'])->middleware('auth', 'admin');
