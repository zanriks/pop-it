<?php

namespace Middlewares;

use Framework\Request;
use Model\ApiToken;

class ApiAuthMiddleware
{
    private ApiToken $apiToken;

    public function __construct()
    {
        $this->apiToken = new ApiToken();
    }

    public function handle(Request $request)
    {
        // Получаем заголовок Authorization
        $authHeader = $request->headers['Authorization'] ?? $request->headers['authorization'] ?? null;

        if (!$authHeader) {
            http_response_code(401);
            echo json_encode(['error' => 'Токен авторизации не предоставлен']);
            exit;
        }

        // Проверяем формат Bearer token
        if (!preg_match('/^Bearer\s+(.+)$/i', $authHeader, $matches)) {
            http_response_code(401);
            echo json_encode(['error' => 'Неверный формат токена. Используйте Bearer token']);
            exit;
        }

        $token = $matches[1];

        // Проверяем токен в БД
        $tokenData = $this->apiToken->where('token', $token)->first();

        if (!$tokenData) {
            http_response_code(401);
            echo json_encode(['error' => 'Недействительный токен авторизации']);
            exit;
        }

        // Получаем пользователя
        $user = $tokenData->user;

        if (!$user) {
            http_response_code(401);
            echo json_encode(['error' => 'Пользователь не найден']);
            exit;
        }

        // Добавляем пользователя в request
        $request->user = $user;

        return $request;
    }
}