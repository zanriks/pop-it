<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Админ панель</title>
    <link rel="stylesheet" href="../../public/css/admin_panel.css"
</head>
<body>
    <section>
        <div>
            <div class="admin-links">
                <a href="<?= app()->route->getUrl('all_users') ?>">Посмотреть таблицу со всеми пользователями</a>
                <a href="<?= app()->route->getUrl('admin_signup') ?>">Добавить нового пользователя</a>
            </div>
        </div>
    </section>
</body>
</html>