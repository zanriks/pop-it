<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../public/css/table.css">
    <title>Все комнаты</title>
    <style>
        .actions a {
            color: #171212;
        }
    </style>
</head>
<body>
<div class="table-container">
    <form method="GET" action="/room/list" class="search-bar">
        <input type="text" name="search"
               placeholder="Поиск по номеру комнаты, этажу или типу..."
               value="<?= htmlspecialchars($search ?? '') ?>">
        <button type="submit">Найти</button>
        <?php if (!empty($search)): ?>
            <a href="/admin/room/list" class="reset">Сбросить</a>
        <?php endif; ?>
    </form>

    <?php if (!empty($search)): ?>
        <div class="search-results-info">
            Найдено: <strong><?= count($rooms) ?></strong> комнат по запросу "<?= htmlspecialchars($search) ?>"
        </div>
    <?php endif; ?>

    <div class="table-header">
        <div>ID здания</div>
        <div>Название здания</div>
        <div>№</div>
        <div>Этаж</div>
        <div>Тип</div>
        <div>Мест</div>
        <div>Действия</div>
    </div>

    <?php if (!empty($rooms)): ?>
        <?php foreach ($rooms as $room): ?>
            <div class="table-row">
                <div><?= $room->buildingId ?></div>
                <div><?= $room->buildingName ?? 'ID: '.$room->buildingId ?></div>
                <div><?= $room->roomNumber ?></div>
                <div><?= $room->floor ?></div>
                <div><?= $room->roomType ?></div>
                <div><?= $room->numberOfTenants ?> / <?= $room->totalBeds ?></div>

                <div class="actions">
                    <a href="/admin/room/edit?roomId=<?= $room->roomId ?>">Редактировать</a>
                    <?php if(app()->auth::user()->role === 'admin'): ?>
                        <form method="POST" action="/admin/room/delete">
                            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                            <input type="hidden" name="roomId" value="<?= $room->roomId ?>">
                            <button type="submit" onclick="return confirm('Удалить комнату?')">
                                Удалить
                            </button>
                        </form>
                    <?php endif ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="table-row" style="grid-template-columns: 1fr; text-align: center; padding: 30px;">
            <div>
                <?php if (!empty($search)): ?>
                    Комнаты по запросу "<?= htmlspecialchars($search) ?>" не найдены
                <?php else: ?>
                    Комнаты не найдены
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <a href="/tenant/booking/create" style="color: #171212; margin-top: 20px; display: inline-block;">Забронировать комнату</a>
</div>
</body>
</html>