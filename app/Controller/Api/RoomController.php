<?php

namespace Controller\Api;

use Framework\Request;
use Framework\View;
use Middlewares\ApiAuthMiddleware;
use Model\Room;

class RoomController
{
    public function getAvailableSeatsByFloor(Request $request): void
    {

        $authMiddleware = new ApiAuthMiddleware();
        try {
            $request = $authMiddleware->handle($request);
        } catch (\Exception $e) {
            // Middleware уже отправляет ответ с ошибкой 401
            return;
        }

        // Получаем все параметры запроса (GET и POST)
        $params = $request->all();

        // Получаем номер этажа из параметров
        $floor = $params['floor'] ?? null;

        // Валидация номера этажа
        if (!$floor || !is_numeric($floor)) {
            http_response_code(400);
            (new View())->toJSON([
                'success' => false,
                'error' => 'Не указан номер этажа или указан некорректно',
                'message' => 'Параметр floor должен быть целым числом. Пример: ?floor=2'
            ]);
            return;
        }

        $floor = (int)$floor;

        // Получаем параметр даты (опционально)
        $date = $params['date'] ?? null;

        // Валидация даты, если указана
        if ($date && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            http_response_code(400);
            (new View())->toJSON([
                'success' => false,
                'error' => 'Неверный формат даты',
                'message' => 'Используйте формат YYYY-MM-DD. Пример: ?date=2024-12-31'
            ]);
            return;
        }

        try {
            // Получаем список комнат со свободными местами
            $rooms = Room::findAvailableSeatsByFloor($floor, $date);

            // Получаем статистику по этажу
            $stats = Room::getFloorStats($floor, $date);

            (new View())->toJSON([
                'success' => true,
                'data' => [
                    'floor' => $floor,
                    'date' => $date ?? date('Y-m-d'),
                    'statistics' => $stats,
                    'rooms' => $rooms
                ]
            ]);

        } catch (\Exception $e) {
            http_response_code(500);
            (new View())->toJSON([
                'success' => false,
                'error' => 'Внутренняя ошибка сервера',
                'message' => $e->getMessage()
            ]);
        }
    }
    public function getAllFloorsStats(Request $request): void
    {
        $date = $request->get('date');

        if ($date && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            http_response_code(400);
            (new View())->toJSON([
                'success' => false,
                'error' => 'Неверный формат даты'
            ]);
            return;
        }

        try {
            // Получаем уникальные этажи из базы
            $floors = Room::select('floor')->distinct()->orderBy('floor')->pluck('floor');

            $allStats = [];
            foreach ($floors as $floor) {
                $allStats[] = Room::getFloorStats($floor, $date);
            }

            (new View())->toJSON([
                'success' => true,
                'data' => [
                    'date' => $date ?? date('Y-m-d'),
                    'floors' => $allStats
                ]
            ]);

        } catch (\Exception $e) {
            http_response_code(500);
            (new View())->toJSON([
                'success' => false,
                'error' => 'Внутренняя ошибка сервера'
            ]);
        }
    }
}