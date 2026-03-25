<?php

namespace Controller;
use Model\User;
use Src\Request;
use Src\View;

class UserController
{
    public function profile(): string
    {
        return new View('site.profile_user');
    }
    public function profile_edit(Request $request): string
    {
        $id = $_GET['id'] ?? null;
        $user = User::all()->find($id);
        if (!$user) {
            app()->route->redirect('/profile/user');
        }
        return new View('admin.profile_edit', ['user' => $user]);
    }
    public function profile_update(Request $request): string
    {
        $id = $request->get('id');
        $data = $request->all();
        $user = User::find($id);
        if ($user) {
            $user->update($data);
            app()->route->redirect('/profile/user');
        }
        return (new View())->render('admin.profile_edit', ['user' => $user]);
    }
}