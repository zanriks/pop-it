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
<section>
    <div>
        <div class="admin-links">
            <a href="<?= app()->route->getUrl('/admin/users/all') ?>">Посмотреть таблицу со всеми пользователями</a>
            <a href="<?= app()->route->getUrl('/admin/building/list') ?>">Посмотреть таблицу со всеми зданиями</a>
            <a href="<?= app()->route->getUrl('/admin/room/list') ?>">Посмотреть таблицу со всеми комнатами</a>
            <a href="<?= app()->route->getUrl('/admin/signup_user') ?>">Добавить нового пользователя</a>
            <a href="<?= app()->route->getUrl('/admin/building/create') ?>">Добавить новое здание</a>
            <a href="<?= app()->route->getUrl('/admin/room/create') ?>">Добавить новую комнату</a>
            <a href="<?= app()->route->getUrl('/admin/debtor_report') ?>">Формирование отчета по должникам</a>
            <a href="<?= app()->route->getUrl('/admin/registrations') ?>">Оформление выселения</a>
        </div>
    </div>
</section>
</body>
</html>