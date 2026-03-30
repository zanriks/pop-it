<?php

namespace Controller;

use Model\Building;
use Model\Room;
use Framework\Request;
use Framework\Validator\Validator;
use Framework\View;

class RoomController
{
    // Добавление комнаты
    public function room_create(Request $request): string
    {
        $buildings = Building::all();
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'buildingId' => ['required'],
                'roomNumber' => ['required', 'numeric'],
                'floor' => ['required'],
                'roomType' => ['required'],
                'totalBeds' => ['required'],
                'numberOfTenants' => ['required']
            ], [
                'required' => 'Поле :field пусто',
                'numeric' => 'Поле :field должно содержать числовое значение'
            ]);
            if ($validator->fails()) {
                return new View('admin.room_create', ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE), 'buildings' => $buildings]);
            }
            if (Room::create($request->all())) {
                app()->route->redirect('/admin/admin_panel');
            }
        }
        return new View('admin.room_create', ['buildings' => $buildings]);
    }
    // Список всех комнат
    public function list_rooms(Request $request): string
    {
        $search = $request->get('search');

        if ($search) {
            // Поиск по номеру комнаты, этажу, типу
            $rooms = Room::where('roomNumber', 'like', "%$search%")
                ->orWhere('floor', 'like', "%$search%")
                ->orWhere('roomType', 'like', "%$search%")
                ->get();
        } else {
            $rooms = Room::all();
        }

        return new View('admin.list_rooms', [
            'rooms' => $rooms,
            'search' => $search
        ]);
    }
    // Удаление записи о комнате
    public function delete_room(Request $request): string
    {
        $id = $request->get('roomId');
        Room::where('roomId', $id)->delete();
        app()->route->redirect('/room/list');
        return '';
    }
    public function room_edit(Request $request): string
    {
        $id = $request->get('roomId');
        $room = Room::where('roomId', $id)->first();
        return new View('admin.room_edit', ['room' => $room]);
    }
    public function room_update(Request $request): string
    {
        $id = $request->all()['roomId'];
        $room = Room::where('roomId', $id)->first();
        if ($room) {
            $room->update($request->all());
            app()->route->redirect('/room/list');
        }
        return (new View())->render('admin.room_edit', ['room' => $room]);
    }
}