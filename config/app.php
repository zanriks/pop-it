<?php
return [
    'auth' => \Framework\Auth\Auth::class,
    'identity' => \Model\User::class,
    'routeMiddleware' => [
        'auth' => \Middlewares\AuthMiddleware::class,
        'admin' => \Middlewares\AdminMiddleware::class,
        'commandant' => \Middlewares\CommandantMiddleware::class,
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
    'routeAppMiddleware' => [
        'csrf' => \Middlewares\CSRFMiddleware::class,
        'trim' => \Middlewares\TrimMiddleware::class,
        'specialChars' => \Middlewares\SpecialCharsMiddleware::class,
    ],
];