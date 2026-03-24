<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Редактирование здания <?= $building->id ?></h1>

    <form action="/building_update?id=<?= $building->id ?>" method="POST">
        <input type="hidden" name="id" value="<?= $building->id ?>">

        <div class="form-group">
            <label>Название здания:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($building->buildingName) ?>" required>
        </div>

        <div class="form-group">
            <label>Адрес:</label>
            <input type="text" name="address" value="<?= htmlspecialchars($building->address) ?>" required>
        </div>

        <div class="form-group">
            <label>Количество этажей:</label>
            <input type="number" name="floors" value="<?= $building->floors ?>">
        </div>

        <div style="margin-top: 20px;">
            <button type="submit" class="btn-save">Сохранить изменения</button>
            <a href="/admin_panel" class="btn-cancel">Отмена</a>
        </div>
    </form>
</body>
</html>