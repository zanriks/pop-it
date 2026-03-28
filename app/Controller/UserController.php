<?php

namespace Controller;
use Model\User;
use Framework\Auth\Auth;
use Framework\Request;
use Framework\Validator\Validator;
use Framework\View;

class UserController
{
    public function profile(Request $request): string
    {
        $user = Auth::user();
        return new View('site.profile_user', ['user' => $user]);
    }
    public function profile_edit(Request $request): string
    {
        $id = Auth::user()->id;
        $currentUser = Auth::user();

        if (!$currentUser) {
            app()->route->redirect('/login');
            return '';
        }
        // Проверка на то что редактировать профиль может только сам пользователь или админ
        if($id != $currentUser->id && $currentUser->role !== 'admin'){
            app()->route->redirect('/profile/user');
            return '';
        }

        $user = User::find($id);
        if (!$user) {
            app()->route->redirect('/profile/user');
            return '';
        }
        return new View('site.profile_edit', ['user' => $user]);
    }
    public function profile_update(Request $request): string
    {
        $currentUser = Auth::user();

        if (!$currentUser) {
            app()->route->redirect('/login');
            return '';
        }

        $id = $request->get('id');

        if ($id !== (int)$currentUser->id && $currentUser->role !== 'admin') {
            app()->route->redirect('/profile/user');
            return '';
        }

        $validator = new Validator($request->all(), [
            'name' => ['required', 'min:4'],
        ], [
            'required' => 'Поле :field обязательно',
            'min' => 'Минимум :min символов'
        ]);

        if ($validator->fails()) {
            return new View('site.profile_edit', [
                'message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE),
                'user' => User::find($id)
            ]);
        }
        $data = $request->all();

        $user = User::find($id);
        if ($user) {
            $user->update($data);
            app()->route->redirect('/profile/user');
            return '';
        }

        app()->route->redirect('/profile/user');
        return '';
    }
}