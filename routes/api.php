<?php

use Framework\Route;

Route::add('GET', '/api/', [Controller\Api::class, 'index']);
Route::add('POST', '/api/echo', [Controller\Api::class, 'echo']);
Route::add('POST', '/api/login', [Controller\Api::class, 'login']);
