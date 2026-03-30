<?php

namespace Controller;

use Framework\Validator\Validator;
use Framework\View;
use Framework\Request;
use Model\User;
use Framework\Auth\Auth;
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
                'login' => ['required', 'min:6', 'login'],
                'password' => ['required', 'min:8'],
                'passportSeries' => ['required', 'min:4', 'max:6'],
                'passportNumber' => ['required', 'min:6', 'max:6'],
            ], [
                'required' => 'Поле :field пусто',
                'login' => 'Поле :field должно',
                'min' => 'Поле :field должно содержать минимум :min символов',
                'max' => 'Поле :field должно содержать максимум :max символов',
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
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'login' => ['required', 'min:6', 'login'],
                'password' => ['required', 'min:8'],
            ], [
                'required' => 'Поле :field пусто',
                'login' => 'Поле :field должно',
                'min' => 'Поле :field должно содержать минимум :min символов',
            ]);
            if ($validator->fails()) {
                return new View('site.login', ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }
        }
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