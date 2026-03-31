<?php

namespace Controller;

use Model\Room;
use Framework\Request;
use Framework\View;
use Model\User;

class Api
{
    public function index(): void
    {
        $rooms = Room::all()->toArray();

        (new View())->toJSON($rooms);
    }

    public function echo(Request $request): void
    {
        (new View())->toJSON($request->all());
    }
    public function login(Request $request): void
    {
        // Генерируем уникальный токен
        $token = bin2hex(random_bytes(32));

        // Сохраняем токен в сессии или базе данных
        // Для простоты используем сессию
        session_start();
        $_SESSION['api_token'] = $token;

        // Возвращаем токен
        (new View())->toJSON([
            'token' => $token,
            'message' => 'Успешная аутентификация'
        ]);
    }
}
