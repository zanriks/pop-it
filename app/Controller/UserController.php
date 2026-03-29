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
            'min' => 'Минимум :min символов',
        ]);

        if ($validator->fails()) {
            return new View('site.profile_edit', [
                'message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE),
                'user' => User::find($id)
            ]);
        }

        $data = $request->all();
        unset($data['avatar']);

        $user = User::find($id);

        if ($user) {
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['avatar'];

                // Проверка расширения файла
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

                if (in_array($extension, $allowedExtensions)) {
                    // Генерация уникального имени файла
                    $fileName = 'avatar_' . $user->id . '_' . time() . '_' . uniqid() . '.' . $extension;

                    // Путь для загрузки
                    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/praktos/public/uploads/avatars/';

                    // Создаём директорию, если не существует
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    $uploadFile = $uploadDir . $fileName;

                    if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                        if ($user->avatar && file_exists($_SERVER['DOCUMENT_ROOT'] . $user->avatar)) {
                            unlink($_SERVER['DOCUMENT_ROOT'] . $user->avatar);
                        }
                        // Сохраняем путь к новому аватару
                        $data['avatar'] = '/praktos/public/uploads/avatars/' . $fileName;
                    }
                } else {
                    return new View('site.profile_edit', [
                        'message' => json_encode(['avatar' => ['Недопустимый формат файла. Разрешены: jpg, jpeg, png, gif, webp']], JSON_UNESCAPED_UNICODE),
                        'user' => $user
                    ]);
                }
            }
            $user->update($data);
            app()->route->redirect('/profile/user');
            return '';
        }

        app()->route->redirect('/profile/user');
        return '';
    }
}