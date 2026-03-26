<?php

namespace Controller;

use Model\Registration;
use Model\User;
use Src\Request;
use Src\View;

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
        if ($request->method === 'POST' && User::create($request->all())) {
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
        $debtors = Registration::where('status', 'unconfirmed')->whereNull('paymentId')->with(['tenant.user', 'room'])->get();
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