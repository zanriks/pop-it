<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../public/css/signup.css">
    <title>Регистрация</title>
</head>
<body>
<main>
    <div class="signup-form-center">
        <div class="signup-form">
            <h2>Регистрация нового пользователя</h2>
            <h3><?= $message ?? ''; ?></h3>
            <form method="post">
                <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                <label>Имя <input type="text" name="name" placeholder="Ваше имя"></label>
                <label>Логин <input type="text" name="login" placeholder="Логин пользователя"></label>
                <label>Пароль <input type="password" name="password" placeholder="Ваш пароль"></label>
                <label>Серия паспорта <input type="text" name="passportSeries" required></label>
                <label>Номер паспорта <input type="text" name="passportNumber" required></label>
                <button>Зарегистрироваться</button>
            </form>
        </div>
    </div>
</main>
</body>
</html>