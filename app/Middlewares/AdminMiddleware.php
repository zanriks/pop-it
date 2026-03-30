<?php

namespace Middlewares;

use Model\User;

class AdminMiddleware
{
    public static function handle() {
        $user = User::find($_SESSION['id']);
        if (!$user || !($user->isAdmin() || $user->isCommandant())) {
            http_response_code(403);
            die('Доступ запрещён. Требуются права администратора!');
        }
    }
}