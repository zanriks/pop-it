<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Вход в аккаунт</title>
    <link rel="stylesheet" href="../../public/css/login.css">
</head>
<body>
<main>
    <div class="login-form-center">
        <div class="login-form">
            <h2>Авторизация</h2>
            <h3><?= $message ?? ''; ?></h3>

            <h3><?= app()->auth->user()->name ?? ''; ?></h3>
            <?php
            if (!app()->auth::check()):
                ?>
                <form method="post">
                    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>">
                    <label>Логин<input type="text" name="login" placeholder="Логин пользователя" required></label>
                    <label>Пароль<input type="password" name="password" placeholder="Ваш пароль" required></label>
                    <button>Войти</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</main>
</body>
</html>