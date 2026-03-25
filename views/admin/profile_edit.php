<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Изменение информации</title>
</head>
<body>
    <h1>Редактирование профиля </h1>

    <form action="/profile/update?id=<?= $user->id ?>" method="POST">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>

        <div class="form-group">
            <label>Фамилия:</label>
            <input type="text" name="surname" value="<?= $user->surname ?>" required>
        </div>

        <div class="form-group">
            <label>Имя:</label>
            <input type="text" name="name" value="<?= $user->name ?>" required>
        </div>

        <div class="form-group">
            <label>Отчество (при наличии):</label>
            <input type="text" name="patronymic" value="<?= $user->patronymic ?>">
        </div>
        <div class="form-group">
            <label>Номер телефона:</label>
            <input type="tel" name="phone" value="<?= $user->phone ?>" required>
        </div>
        <div class="form-group">
            <label>Почта:</label>
            <input type="email" name="email" value="<?= $user->email ?>">
        </div>
        <div style="margin-top: 20px;">
            <button type="submit">Сохранить изменения</button>
            <a href="/admin/admin_panel">Отмена</a>
        </div>
    </form>
</body>
</html>