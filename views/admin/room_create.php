<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Создание новой комнаты</title>
    <link rel="stylesheet" href="../../public/css/form.css">
</head>
<body>
<main>
    <div class="form-center">
        <div class="form">
            <h1>Добавить новую комнату</h1>

            <form action="/admin/room/create" method="post">
                <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                <div class="form-group">
                    <label>Здание:</label>
                    <select name="buildingId" id="buildingId" required>
                        <option value="">Выберите здание</option>
                        <?php foreach ($buildings as $building): ?>
                            <option value="<?= $building->buildingId ?>">
                                <?= $building->buildingName ?> (<?= $building->address ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <label>Номер комнаты:<input type="text" name="roomNumber" placeholder="Например: 301А" required></label>
                <label>Этаж:<input type="number" name="floor" min="1" required></label>
                <label>Тип комнаты:
                <select name="roomType">
                    <option value="male">Мужская</option>
                    <option value="female">Женская</option>
                    <option value="family">Семейная</option>
                </select>
                </label>
                <label>Всего спальных мест:<input type="number" name="totalBeds" min="1" value="2" required></label>
                <label>Текущее кол-во жильцов:<input type="number" name="numberOfTenants" min="0" value="0"></label>
                <button type="submit">Создать комнату</button>
                <a href="/admin/admin_panel">Отмена</a>
            </form>
        </div>
    </div>
</main>
</body>
</html>