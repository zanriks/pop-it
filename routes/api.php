<?php

use Framework\Route;

Route::add('GET', '/api/', [Controller\Api::class, 'index'])->middleware('token');
Route::add('POST', '/api/echo', [Controller\Api::class, 'echo'])->middleware('token');
Route::add('POST', '/api/login', [Controller\Api::class, 'login']);
Route::add('POST', '/api/logout', [Controller\Api::class, 'logout'])->middleware('token');
Route::add('GET', '/api/me', [Controller\Api::class, 'profile'])->middleware('token');


Route::add('GET', '/api/floor', [Controller\Api\RoomController::class, 'getAvailableSeatsByFloor'])->middleware('token');
Route::add('GET', '/api/all/floors', [Controller\Api\RoomController::class, 'getAllFloorsStats'])->middleware('token');