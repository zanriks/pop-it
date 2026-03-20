<?php

namespace Controller;

use Model\User;
use Src\Request;
use Src\View;

class AdminController
{
    public function admin_signup(Request $request): string
    {
        if ($request->method === 'POST' && User::create($request->all())) {
            app()->route->redirect('/hello');
        }
        return new View('admin.admin_signup');
    }
    public function all_users(Request $request): string
    {
        $users = User::all();
        return new View('admin.all_users', ['users' => $users]);
    }
    public function admin_panel(Request $request): string
    {
        return new View('admin.admin_panel');
    }
}