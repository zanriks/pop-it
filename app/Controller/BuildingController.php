<?php

namespace Controller;

use Model\Building;
use Src\Request;
use Src\Validator\Validator;
use Src\View;

class BuildingController
{
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
                app()->route->redirect('/admin/admin_panel');
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
        app()->route->redirect('/admin/admin_panel');
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
            app()->route->redirect('/admin/building/list');
        }
        return (new View())->render('admin.building_edit', ['building' => $building]);
    }
}