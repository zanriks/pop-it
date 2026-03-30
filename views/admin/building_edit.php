<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../public/css/form.css">
    <title>Изменение информации о здании</title>
</head>
<body>
<div class="form-center">
    <div class="form">
        <h1>Редактирование здания <?= $building->buildingId ?></h1>

        <form action="/admin/building/update" method="POST">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <input type="hidden" name="buildingId" value="<?= $building->buildingId ?>">

            <label>Название здания:
                <input type="text" name="buildingName" value="<?= htmlspecialchars($building->buildingName) ?>" required>
            </label>

            <label>Адрес:
                <input type="text" name="address" value="<?= htmlspecialchars($building->address) ?>" required>
            </label>

            <label>Количество этажей:
                <input type="number" name="floors" value="<?= $building->floors ?>">
            </label>

            <button type="submit" class="btn-save">Сохранить изменения</button>
            <a href="/admin/admin_panel" class="btn-cancel">Отмена</a>
        </form>
    </div>
</div>
</body>
</html>