<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../public/css/signup.css">
    <title>Все пользователи</title>
    <style>
        .table-container {
            width: 100%;
            max-width: 1440px;
            margin: 0 auto;
            border-radius: 8px;
            font-family: sans-serif;
        }

        .table-header, .table-row {
            display: grid;
            grid-template-columns: 60px repeat(7, 1.2fr);
            align-items: center;
            padding: 12px 20px;
        }

        .table-header {
            background-color: #171212;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
        }

        .table-row {
            border-bottom: 1px solid #eee;
        }
    </style>
</head>
<body>
<div class="table-container">
    <form method="GET" action="/admin/users/all" class="search-bar">
        <input type="text" name="search"
               placeholder="Поиск по имени, фамилии, логину, email или телефону..."
               value="<?= htmlspecialchars($search ?? '') ?>">
        <button type="submit">Найти</button>
        <?php if (!empty($search)): ?>
            <a href="/admin/users" class="reset">Сбросить</a>
        <?php endif; ?>
    </form>

    <?php if (!empty($search)): ?>
        <div class="search-results-info">
            Найдено: <strong><?= count($users) ?></strong>
            <?php if (count($users) === 1): ?>
                пользователь
            <?php elseif (count($users) < 5): ?>
                пользователя
            <?php else: ?>
                пользователей
            <?php endif; ?>
            по запросу "<?= htmlspecialchars($search) ?>"
        </div>
    <?php endif; ?>

    <div class="table-header">
        <div>ID</div>
        <div>Фамилия</div>
        <div>Имя</div>
        <div>Отчество</div>
        <div>Телефон</div>
        <div>Email</div>
        <div>Логин</div>
        <div>Роль</div>
    </div>

    <?php if (!empty($users)): ?>
        <?php foreach ($users as $user): ?>
            <div class="table-row">
                <div><?= htmlspecialchars($user->id) ?></div>
                <div><?= htmlspecialchars($user->surname) ?></div>
                <div><?= htmlspecialchars($user->name) ?></div>
                <div><?= htmlspecialchars($user->patronymic) ?></div>
                <div><?= htmlspecialchars($user->phone) ?></div>
                <div><?= htmlspecialchars($user->email) ?></div>
                <div><?= htmlspecialchars($user->login) ?></div>
                <div><?= htmlspecialchars($user->role) ?></div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="table-row" style="grid-template-columns: 1fr; text-align: center; padding: 30px;">
            <div>
                <?php if (!empty($search)): ?>
                    Пользователи по запросу "<?= htmlspecialchars($search) ?>" не найдены
                <?php else: ?>
                    Пользователи не найдены
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
</body>
</html>