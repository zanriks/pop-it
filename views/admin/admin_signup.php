<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../public/css/signup.css">
    <title>Добавление нового пользователя</title>
</head>
<body>
<div class="signup-form-center">
    <div class="signup-form">
        <h2>Регистрация нового пользователя</h2>
        <h3><?= $message ?? ''; ?></h3>
        <form method="post">
            <label>Фамилия <input type="text" name="surname" placeholder="Ваша фамилия"></label>
            <label>Имя <input type="text" name="name" placeholder="Имя"></label>
            <label>Отчество <input type="text" name="patronymic" placeholder="Отчество (при наличии)"></label>
            <label>Номер телефона<input type="tel" name="phone" placeholder="Номер телефона"></label>
            <label>Почта<input type="email" name="email" placeholder="example@mail.ru"></label>
            <label>Логин<input type="text" name="login" placeholder="Логин пользователя"></label>
            <label>Пароль<input type="password" name="password" placeholder="Пароль"></label>
            <label for="role">Выберите роль:</label>
            <select name="role" id="role">
                <option value="admin">Администратор</option>
                <option value="commandant">Коммендант</option>
                <option value="tenant">Жилец</option>
            </select>
            <button>Зарегистрироваться</button>
        </form>
    </div>
</div>
</body>
</html>