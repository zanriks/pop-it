<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../public/css/main.css">
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
            grid-template-columns: 60px 1.5fr 2fr 1.2fr 1.5fr;
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
        <div>Название</div>
        <div>Адрес</div>
        <div>Телефон</div>
        <div>Действия</div>
    </div>

    <?php if (!empty($buildings)): ?>
        <?php foreach ($buildings as $building): ?>
            <div class="table-row">
                <div><?= $building->buildingId ?></div>
                <div><?= $building->buildingName ?></div>
                <div><?= $building->address ?></div>
                <div><?= $building->phone ?></div>

                <div class="actions">
                    <a href="/building_edit?buildingId=<?= $building->buildingId ?>" style="color: #1c6d7a;">Редактировать</a>
                    <a href="/delete_building?buildingId=<?= $building->buildingId ?>"
                       onclick="return confirm('Удалить здание?')" style="color: red;">Удалить</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="table-row">
            <div>Здания не найдены</div>
        </div>
    <?php endif; ?>
</div>
</body>
</html>