<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../public/css/signup.css">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
        }
        th, td {
            padding: 10px 15px;
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Фамилия</th>
                <th>Имя</th>
                <th>Отчество</th>
                <th>Номер телефона</th>
                <th>Email</th>
                <th>Логин</th>
                <th>Роль</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($users)): ?>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user->id ?></td>
                <td><?= $user->surname ?></td>
                <td><?= $user->name ?></td>
                <td><?= $user->patronymic ?></td>
                <td><?= $user->phone ?></td>
                <td><?= $user->email ?></td>
                <td><?= $user->login ?></td>
                <td><?= $user->role ?></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
        <tr>
            <td>Пользователи не найдены</td>
        </tr>
        <?php endif; ?>
        </tbody>
    </table>
</body>
</html>