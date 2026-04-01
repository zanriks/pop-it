<?php

namespace Controller;

use Model\ApiToken;
use Model\User;
use Framework\Request;
use Framework\View;

class Api
{
    private ApiToken $apiToken;

    public function __construct()
    {
        $this->apiToken = new ApiToken();
    }

    public function index(): void
    {
        $rooms = \Model\Room::all()->toArray();
        (new View())->toJSON($rooms);
    }

    public function echo(Request $request): void
    {
        (new View())->toJSON($request->all());
    }

    public function login(Request $request): void
    {
        $params = $request->all();

        $login = $params['login'] ?? null;
        $password = $params['password'] ?? null;

        if (!$login || !$password) {
            http_response_code(400);
            (new View())->toJSON([
                'error' => 'Не указаны логин или пароль'
            ]);
            return;
        }

        // Ищем пользователя
        $user = User::where('login', $login)
            ->where('password', md5($password))
            ->first();

        if (!$user) {
            http_response_code(401);
            (new View())->toJSON([
                'error' => 'Неверный логин или пароль'
            ]);
            return;
        }

        // Создаем токен в БД
        $token = $this->apiToken->createToken($user->id);

        (new View())->toJSON([
            'token' => $token,
            'message' => 'Успешная аутентификация'
        ]);
    }

    public function logout(Request $request): void
    {
        // Получаем токен напрямую из заголовков
        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? $headers['authorization'] ?? null;

        $token = null;
        if ($authHeader && preg_match('/^Bearer\s+(.+)$/i', $authHeader, $matches)) {
            $token = $matches[1];
        }

        if ($token && $this->apiToken->clearToken($token)) {
            (new View())->toJSON([
                'success' => true,
                'message' => 'Успешный выход из системы'
            ]);
        } else {
            http_response_code(400);
            (new View())->toJSON([
                'success' => false,
                'error' => 'Не удалось завершить сессию'
            ]);
        }
    }

    public function profile(Request $request): void
    {
        $user = $request->user;

        if (!$user) {
            http_response_code(401);
            (new View())->toJSON([
                'error' => 'Пользователь не авторизован'
            ]);
            return;
        }

        (new View())->toJSON([
            'success' => true,
            'data' => [
                'id' => $user->id,
                'login' => $user->login,
                'name' => $user->name,
                'surname' => $user->surname,
                'patronymic' => $user->patronymic,
                'email' => $user->email,
                'phone' => $user->phone,
            ]
        ]);
    }
}