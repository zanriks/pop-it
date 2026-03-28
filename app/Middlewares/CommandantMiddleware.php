<?php

namespace Middlewares;

use Framework\Auth\Auth;
use Model\User;

class CommandantMiddleware
{
    public static function handle() {
        $user = User::find($_SESSION['id']);
        if (!$user || Auth::user()->role !== 'commandant') {
            http_response_code(403);
            die('Доступ запрещён. Требуются права комменданта!');
        }
    }
}