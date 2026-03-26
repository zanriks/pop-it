<?php

use Src\Route;
Route::add('GET', '/', [Controller\Site::class, 'index']);
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout'])->middleware('auth');
//Профиль пользователя
Route::add('GET', '/profile/user', [Controller\UserController::class, 'profile'])->middleware('auth');
Route::add(['GET', 'POST'], '/profile/edit', [Controller\UserController::class, 'profile_edit'])->middleware('auth');
Route::add(['GET', 'POST'], '/profile/update', [Controller\UserController::class, 'profile_update'])->middleware('auth');

// Маршруты для администратора
Route::add(['GET', 'POST'], '/admin/signup_user', [Controller\AdminController::class, 'admin_signup_user'])->middleware('auth', 'admin');
Route::add('GET', '/admin/users/all', [Controller\AdminController::class, 'all_users'])->middleware('auth', 'admin');
Route::add('GET', '/admin/admin_panel', [Controller\AdminController::class, 'admin_panel'])->middleware('auth', 'admin');

// Маршруты для работы со зданиями
Route::add(['GET', 'POST'], '/admin/building/create', [Controller\BuildingController::class, 'building_create'])->middleware('auth', 'admin');
Route::add('GET', '/admin/building/list', [Controller\BuildingController::class, 'list_buildings'])->middleware('auth', 'admin');
Route::add('GET', '/admin/building/edit', [Controller\BuildingController::class, 'building_edit'])->middleware('auth', 'admin');
Route::add('POST', '/admin/building/update', [Controller\BuildingController::class, 'building_update'])->middleware('auth', 'admin');
Route::add('POST', '/admin/building/delete', [Controller\BuildingController::class, 'delete_building'])->middleware('auth', 'admin');

// Маршруты для работы с комнатами
Route::add(['GET', 'POST'], '/admin/room/create', [Controller\RoomController::class, 'room_create'])->middleware('auth', 'admin');
Route::add('GET', '/admin/room/list', [Controller\RoomController::class, 'list_rooms'])->middleware('auth', 'admin');
Route::add('GET', '/admin/room/edit', [Controller\RoomController::class, 'room_edit'])->middleware('auth', 'admin');
Route::add('POST', '/admin/room/update', [Controller\RoomController::class, 'room_update'])->middleware('auth', 'admin');
Route::add('POST', '/admin/room/delete', [Controller\RoomController::class, 'delete_room'])->middleware('auth', 'admin');
// Управление бронированиями
Route::add('GET', '/admin/registrations', [Controller\AdminController::class, 'allRegistrations'])->middleware('auth', 'admin');
Route::add('POST', '/admin/registration/confirm', [Controller\AdminController::class, 'confirmRegistration'])->middleware('auth', 'admin');
Route::add('POST', '/admin/registration/checkin', [Controller\RegistrationController::class, 'checkIn'])->middleware('auth', 'admin');
Route::add('POST', '/admin/registration/checkout', [Controller\RegistrationController::class, 'checkOut'])->middleware('auth', 'admin');
// Бронирование
Route::add(['GET', 'POST'], '/tenant/booking/create', [Controller\RegistrationController::class, 'create'])->middleware('auth');
// Мои брони
Route::add('GET', '/profile/my_bookings', [Controller\RegistrationController::class, 'myBookings'])->middleware('auth');
// Отмена брони
Route::add('POST', '/tenant/booking/cancel', [Controller\RegistrationController::class, 'cancelBooking'])->middleware('auth');

// Отчёты
Route::add('GET', '/admin/debtor_report', [Controller\AdminController::class, 'debtorReport'])->middleware('auth', 'admin');

// Оплата
Route::add(['GET', 'POST'], '/payment/pay', [Controller\PaymentController::class, 'payBooking'])->middleware('auth');

Route::add(['GET', 'POST'], '/user/create/tenant', [Controller\TenantController::class, 'createTenant'])->middleware('auth');