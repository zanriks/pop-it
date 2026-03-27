<?php

namespace Middlewares;

use Model\User;
use Src\Request;

class CommandantMiddleware
{
    public static function handle() {
        $user = User::find($_SESSION['id']);
        if (!$user || !$user->isCommandant()) {
            http_response_code(403);
            die('Доступ запрещён. Требуются права комменданта!');
        }
    }
}