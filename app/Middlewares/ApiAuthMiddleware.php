<?php

namespace Middlewares;

use Framework\Request;

class ApiAuthMiddleware
{
    public function handle(Request $request): Request
    {
        session_start();

        // Получаем токен из заголовка
        $headers = getallheaders();
        $token = $headers['Authorization'] ?? $headers['authorization'] ?? null;

        // Убираем 'Bearer ' если есть
        if ($token && strpos($token, 'Bearer ') === 0) {
            $token = substr($token, 7);
        }

        // Проверяем токен
        if (!$token || !isset($_SESSION['api_token']) || $_SESSION['api_token'] !== $token) {
            http_response_code(401);
            echo json_encode(['error' => 'Неавторизованный доступ']);
            exit;
        }

        return $request;
    }
}