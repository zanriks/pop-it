<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../public/css/main.css">
    <title>Все здании</title>
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
            grid-template-columns: 60px 1.5fr 2fr 1.2fr 1.5fr 1.5fr;
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
    <form method="GET" action="/admin/building/list" class="search-bar">
        <input type="text" name="search"
               placeholder="Поиск по названию здания, адресу или телефону..."
               value="<?= htmlspecialchars($search ?? '') ?>">
        <button type="submit">Найти</button>
        <?php if (!empty($search)): ?>
            <a href="/admin/building/list" class="reset">Сбросить</a>
        <?php endif; ?>
    </form>

    <?php if (!empty($search)): ?>
        <div class="search-results-info">
            Найдено: <strong><?= count($buildings) ?></strong> зданий по запросу "<?= htmlspecialchars($search) ?>"
        </div>
    <?php endif; ?>

    <div class="table-header">
        <div>ID</div>
        <div>Название</div>
        <div>Адрес</div>
        <div>Телефон</div>
        <div>Этажи</div>
        <div>Действия</div>
    </div>

    <?php if (!empty($buildings)): ?>
        <?php foreach ($buildings as $building): ?>
            <div class="table-row">
                <div><?= $building->buildingId ?></div>
                <div><?= htmlspecialchars($building->buildingName) ?></div>
                <div><?= htmlspecialchars($building->address) ?></div>
                <div><?= htmlspecialchars($building->phone) ?></div>
                <div><?= $building->floors ?></div>

                <div class="actions">
                    <a href="/admin/building/edit?buildingId=<?= $building->buildingId ?>">Редактировать</a>
                    <form method="POST" action="/admin/building/delete" style="display: inline;">
                        <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">
                        <input type="hidden" name="buildingId" value="<?= $building->buildingId ?>">
                        <button type="submit" onclick="return confirm('Удалить здание?')">Удалить</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="table-row" style="grid-template-columns: 1fr; text-align: center; padding: 30px;">
            <div>
                <?php if (!empty($search)): ?>
                    Здания по запросу "<?= htmlspecialchars($search) ?>" не найдены
                <?php else: ?>
                    Здания не найдены
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
</body>
</html>