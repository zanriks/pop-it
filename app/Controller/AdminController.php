<?php

namespace Controller;

use Model\Building;
use Model\Room;
use Model\User;
use Src\Request;
use Src\Validator\Validator;
use Src\View;

class AdminController
{
    // Метод для панели администратора
    public function admin_panel(Request $request): string
    {
        return new View('admin.admin_panel');
    }
    // Метод добавления пользователя администратором
    public function admin_signup_user(Request $request): string
    {
        if ($request->method === 'POST' && User::create($request->all())) {
            app()->route->redirect('/hello');
        }
        return new View('admin.admin_signup');
    }
    // Вывод всех пользователей для просмотра
    public function all_users(Request $request): string
    {
        $users = User::all();
        return new View('admin.all_users', ['users' => $users]);
    }
    // Добавление здания
    public function building_create(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'buildingName' => ['required'],
                'address' => ['required'],
                'phone' => ['required'],
                'floors' => ['required']
            ], [
                'required' => 'Поле :field пусто'
            ]);
            if ($validator->fails()) {
                return new View('admin.building_create', ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }
            if (Building::create($request->all())) {
                app()->route->redirect('/admin_panel');
            }
        }
        return new View('admin.building_create');
    }
    // Список всех зданий
    public function list_buildings(Request $request): string
    {
        $buildings = Building::all();
        return new View('admin.list_buildings', ['buildings' => $buildings]);
    }
    // Удаление записи о здании
    public function delete_building(Request $request): string
    {
        $id = $request->get('buildingId');
        Building::where('buildingId', $id)->delete();
        app()->route->redirect('/admin_panel');
        return '';
    }
    // Методы для редактирования информации о здании
    public function building_edit(Request $request): string
    {
        $id = $request->get('buildingId');
        $building = Building::all()->find($id);
        return new View('admin.building_edit', ['building' => $building]);
    }
    public function building_update(Request $request): string
    {
        $id = $request->get('buildingId');
        $building = Building::where('buildingId', $id)->first();
        if ($building) {
            $building->update($request->all());
            app()->route->redirect('/list_buildings');
        }
        return (new View())->render('admin.building_edit', ['building' => $building]);
    }
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
                return new View('admin.admin_panel', ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE), 'buildings' => $buildings]);
            }
            if (Room::create($request->all())) {
                app()->route->redirect('/admin_panel');
            }
        }
        return new View('admin.room_create', ['buildings' => $buildings]);
    }
    // Список всех комнат
    public function list_rooms(Request $request): string
    {
        $rooms = Room::all();
        return new View('admin.list_rooms', ['rooms' => $rooms]);
    }
    // Удаление записи о комнате
    public function delete_room(Request $request): string
    {
        $id = $request->get('roomId');
        Room::where('roomId', $id)->delete();
        app()->route->redirect('/admin_panel');
        return '';
    }
}