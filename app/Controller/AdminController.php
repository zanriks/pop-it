<?php

namespace Controller;

use Framework\Validator\Validator;
use Illuminate\Support\Str;
use Model\Registration;
use Model\User;
use Framework\Request;
use Framework\View;

class AdminController
{
    // Метод для панели администратора
    public function admin_panel(): string
    {
        return new View('admin.admin_panel');
    }
    // Метод добавления пользователя администратором
    public function admin_signup_user(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required', 'min:5'],
                'login' => ['required', 'unique:users,login', 'min:6', 'login'],
                'password' => ['required', 'min:8', 'password'],
                'email' => ['required', 'email'],
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
            app()->route->redirect('/');
        }
        return new View('admin.admin_signup');
    }
    // Вывод всех пользователей для просмотра
    public function all_users(): string
    {
        $users = User::all();
        return new View('admin.all_users', ['users' => $users]);
    }
    public function debtorReport(): string
    {
        $debtors = Registration::where('status', 'cancelled')->whereNull('paymentId')->with(['tenant.user', 'room'])->get();
        return new View('admin.debtor_report', ['debtors' => $debtors]);
    }
    public function confirmRegistration(Request $request): string
    {
        $id = $request->get('id');
        $registration = Registration::find($id);

        if ($registration && $registration->status === 'awaiting') {
            $registration->update(['status' => 'confirmed']);
        }
        app()->route->redirect('/admin/registration');
        return '';
    }
    public function allRegistrations(): string
    {
        $registrations = Registration::with(['tenant.user', 'room.building'])->get();
        return new View('admin.registrations', ['registrations' => $registrations]);
    }
}