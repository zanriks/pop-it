<?php

namespace Controller;
use Model\User;
use Src\Auth\Auth;
use Src\Request;
use Src\Validator\Validator;
use Src\View;

class UserController
{
    public function profile(): string
    {
        $user = Auth::user();
        return new View('site.profile_user', ['user' => $user]);
    }
    public function profile_edit(Request $request): string
    {
        $id = $request->get('id');
        $currentUser = Auth::user();

        // Проверка на то что редактировать профиль может только сам пользователь или админ
        if($id != $currentUser->id && $currentUser->role !== 'admin'){
            app()->route->redirect('/profile/user');
        }

        $user = User::find($id);
        if (!$user) {
            app()->route->redirect('/profile/user');
        }
        return new View('site.profile_edit', ['user' => $user]);
    }
    public function profile_update(Request $request): string
    {
        $id = $request->get('id');
        $currentUser = User::user();

        if($id != $currentUser->id && $currentUser->role !== 'admin'){
            app()->route->redirect('/profile/user');
        }

        $validator = new Validator($request->all(), [
            'name' => ['required', 'min:4'],
            'email' => ['required', 'email'],
            'password' => ['nullable', 'min:8',],
        ], [
            'required' => 'Поле :field обязательно',
            'email' => 'Некорректный формат email',
            'min' => 'Минимум :min символов'
        ]);

        if ($validator->fails()) {
            return new View('site.profile_edit', ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
        }
        $data = $request->all();

        $user = User::find($id);
        if ($user) {
            $user->update($data);
            app()->route->redirect('/profile/user');
        }
        return (new View())->render('site.profile_edit', ['user' => $user]);
    }
}