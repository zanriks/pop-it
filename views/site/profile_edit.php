<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Изменение информации</title>
    <link rel="stylesheet" href="../../public/css/form.css">
</head>
<body>
<div class="form-center">
    <div class="form">
        <h1>Редактирование профиля </h1>

        <form action="/profile/update?id=<?= $user->id ?>" method="post">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <label>Фамилия: <input type="text" name="surname" value="<?= $user->surname ?>" required></label>
            <label>Имя: <input type="text" name="name" value="<?= $user->name ?>" required></label>
            <label>Отчество (при наличии): <input type="text" name="patronymic" value="<?= $user->patronymic ?>"></label>
            <label>Номер телефона:<input type="tel" name="phone" value="<?= $user->phone ?>" required></label>
            <label>Почта:<input type="email" name="email" value="<?= $user->email ?>"></label>
            <label>Аватар:<input type="file" name="avatar" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"></label>
            <button type="submit">Сохранить изменения</button>
            <a href="/admin/admin_panel">Отмена</a>
        </form>
    </div>
</div>
</body>
</html>