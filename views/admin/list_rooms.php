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
        .table-container {
            width: 100%;
            max-width: 1440px;
            margin: 0 auto;
            border-radius: 8px;
            font-family: sans-serif;
        }

        .table-header, .table-row {
            display: grid;
            grid-template-columns: 60px 1.5fr 2fr repeat(4, 1.2fr);
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
    <div class="table-header">
        <div>ID</div>
        <div>Здание</div>
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
                    <a href="/delete_room?room_id=<?= $room->buildingId ?>"
                       onclick="return confirm('Удалить комнату?')"
                       style="color: red;">Удалить</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="table-row">
            <div>Комнаты не найдены</div>
        </div>
    <?php endif; ?>
</div>
</body>
</html>