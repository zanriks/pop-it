<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Профиль</title>
    <link rel="stylesheet" href="../../public/css/profile_user.css">
</head>
<body>
<main>
    <section class="profile-info">
        <h1>Профиль</h1>
        <p>Привет, <?= app()->auth::user()->name ?>!</p>
        <a href="<?= app()->route->getUrl('/tenant/booking/create') ?>">Забронировать комнату</a>
        <a href="<?= app()->route->getUrl('/profile/my_bookings') ?>">Мои бронирования</a>
        <a href="<?= app()->route->getUrl('/profile/edit') ?>">Редактировать профиль</a>
        <a href="<?= app()->route->getUrl('/logout') ?>">Выйти</a>
    </section>
</main>
</body>
</html>