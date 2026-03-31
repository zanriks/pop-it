<?php
return [
    'auth' => \Framework\Auth\Auth::class,
    'identity' => \Model\User::class,
    'routeMiddleware' => [
        'auth' => \Middlewares\AuthMiddleware::class,
        'admin' => \Middlewares\AdminMiddleware::class,
        'commandant' => \Middlewares\CommandantMiddleware::class,
        'token' => \Middlewares\ApiAuthMiddleware::class,
    ],
    'validators' => [
        'required' => \Validators\RequireValidator::class,
        'unique' => \Validators\UniqueValidator::class,
        'min' => \Validators\MinRule::class,
        'max' => \Validators\MaxRule::class,
        'email' => \Validators\EmailValidator::class,
        'cyrillic' => \Validators\CyrillicValidator::class,
        'numeric' => \Validators\NumericValidator::class,
        'password' => \Validators\PasswordValidator::class,
        'login' => \Validators\LoginValidator::class
    ],
    //Классы для middleware
    'routeAppMiddleware' => [
        'csrf' => \Middlewares\CSRFMiddleware::class,
        'specialChars' => \Middlewares\SpecialCharsMiddleware::class,
        'trim' => \Middlewares\TrimMiddleware::class,
        'json' => \Middlewares\JSONMiddleware::class,
    ],

    'providers' => [
        'kernel' => \Providers\KernelProvider::class,
        'route' => \Providers\RouteProvider::class,
        'db' => \Providers\DBProvider::class,
        'auth' => \Providers\AuthProvider::class,
    ],
];