<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../public/css/signup.css">
    <title>Document</title>
</head>
<body>
<div class="signup-form-center">
    <div class="signup-form">
        <h2>Регистрация нового пользователя</h2>
        <h3><?= $message ?? ''; ?></h3>
        <form method="post">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <label>Имя <input type="text" name="name" placeholder="your name"></label>
            <label>Логин <input type="text" name="login" placeholder="username"></label>
            <label>Пароль <input type="password" name="password" placeholder="password"></label>
            <button>Зарегистрироваться</button>
        </form>
    </div>
</div>
</body>
</html>