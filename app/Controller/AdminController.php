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
}