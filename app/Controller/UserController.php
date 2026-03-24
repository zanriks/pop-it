<?php

namespace Controller;
use Model\User;
use Src\Request;
use Src\View;

class UserController // здесь пишутся методы CRUD
{
    public function profile(): string
    {
        return new View('site.profile_user');
    }
    public function profile_edit(Request $request): string
    {
        $id = $request->get('id');
        $user = User::all()->find($id);
        return new View('admin.profile_edit');
    }
    public function profile_update(Request $request): string
    {
        $id = $request->get('id');
        $user = User::where('id', $id)->first();
        if ($user) {
            $user->update($request->all());
            app()->route->redirect('/list_buildings');
        }
        return (new View())->render('admin.profile_edit');
    }
}