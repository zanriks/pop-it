<?php

namespace Controller;

use Model\Building;
use Model\Registration;
use Model\Room;
use Src\Request;
use Src\Validator\Validator;
use Src\View;

class RoomController
{
    // Добавление комнаты
    public function room_create(Request $request): string
    {
        $buildings = Building::all();
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'buildingId' => ['required'],
                'roomNumber' => ['required'],
                'floor' => ['required'],
                'roomType' => ['required'],
                'totalBeds' => ['required'],
                'numberOfTenants' => ['required']
            ], [
                'required' => 'Поле :field пусто'
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
    public function list_rooms(): string
    {
        $rooms = Room::all();
        return new View('admin.list_rooms', ['rooms' => $rooms]);
    }
    // Удаление записи о комнате
    public function delete_room(Request $request): string
    {
        $id = $request->get('roomId');
        Room::where('roomId', $id)->delete();
        app()->route->redirect('/admin/admin_panel');
        return new View('admin.room_delete', ['roomId' => $id]);
    }
    public function room_edit(Request $request): string
    {
        $id = $request->get('roomId');
        $room = Room::all()->find($id);
        return new View('admin.room_edit', ['room' => $room]);
    }
    public function room_update(Request $request): string
    {
        $id = $request->all()['roomId'];
        $room = Room::where('buildingId', $id)->get();
        if ($room) {
            $room->update($request->all());
            app()->route->redirect('/admin/building/list');
        }
        return (new View())->render('admin.room_edit', ['room' => $room]);
    }
    public function booking(Request $request): string
    {
        $room = Room::where('roomId', $request->get('roomId'))->first();
        $data['roomId'] = app()->auth->user()->id;
        if($request->method === 'POST') {
            if(Registration::create($data)) {
                $room->increment('numberOfTenants');
                app()->route->redirect('/profile/my_bookings');
            }
        }
        return new View('site.book_form', ['room' => $room]);
    }
}