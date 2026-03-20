<?php

namespace Middlewares;

use Model\User;
use Src\Request;

class AdminMiddleware
{
    public static function handle(Request $request) {
        $user = User::find($_SESSION['id']);
        if (!$user || !$user->isAdmin()) {
            http_response_code(403);
            die('Доступ запрещён. Требуются права администратора!');
        }
    }
}