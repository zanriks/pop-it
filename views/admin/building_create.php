<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Админ панель</title>
    <link rel="stylesheet" href="../../public/css/admin_panel.css">
</head>
<body>
<main>
    <h1>Добавить новое здание</h1>

    <form action="/building_create" method="POST">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <label>Название здания:<input type="text" name="buildingName" placeholder="Например: ЖК 'Радуга'" required></label>
        <label>Адрес:<input type="text" name="address" placeholder="ул. Ленина, д. 10" required></label>
        <label>Номер телефона<input type="tel" name="phone"></label>
        <label>Количество этажей:<input type="number" name="floors" min="1" value="1"></label>
        <button type="submit">Создать здание</button>
        <a href="/admin_panel" style="color: #171212">Назад к списку</a>
    </form>
</main>
</body>
</html>