<?php

namespace Controller;

use Model\Post;
use Src\Validator\Validator;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;
class Site
{
    public function index(): string
    {
        return new View('site.post');
    }

    public function signup(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required', 'min:5'],
                'login' => ['required', 'unique', 'min:6'],
                'password' => ['required', 'min:8'],
                'passportSeries' => ['required', 'max:4', 'numeric'],
                'passportNumber' => ['required', 'max:6', 'numeric'],
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально',
                'min' => 'Поле :field должно содержать минимум :min символов',
                'max' => 'Поле :field должно содержать максимум :max символов',
                'numeric' => 'Поле :field должно содержать числовое значение'
            ]);
            if ($validator->fails()) {
                return new View('site.signup', ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            $user = User::create($request->all());

            if ($user) {
                \Model\Tenant::create([
                    'userId' => $user->id,
                    'passportSeries' => $request->get('passportSeries'),
                    'passportNumber' => $request->get('passportNumber'),
                    'status' => 'unliving'
                ]);
                app()->route->redirect('/login');
                return '';
            }
        }
        return new View('site.signup');
    }
    public function login(Request $request): string
    {
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/');
        }
        return new View('site.login', ['message' => 'Неправильный логин или пароль']);
    }
    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/');
    }
}