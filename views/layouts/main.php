<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../public/css/main.css">
    <title>Pop it MVC</title>
</head>
<body>
    <header>
        <nav>
            <a href="<?= app()->route->getUrl('/') ?>">Главная</a>
            <div class="user-notauth">
            <?php if (!app()->auth::check()): ?>
                <a href="<?= app()->route->getUrl('/login') ?>">Вход</a>
                <a href="<?= app()->route->getUrl('/signup') ?>">Регистрация</a>
            </div>
            <?php else: ?>
                <a href="<?= app()->route->getUrl('/profile/user') ?>">Профиль</a>
                <a href="<?= app()->route->getUrl('/logout') ?>">Выход</a>
            <?php
            endif;
            ?>
            <?php if(app()->auth::user()->role === 'admin'): ?>
            <a href="<?= app()->route->getUrl('/admin/admin_panel') ?>">Админ панель</a>
            <?php endif ?>
        </nav>
    </header>
<main>
    <?= $content ?? '' ?>
</main>

</body>
</html>
