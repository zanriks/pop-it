<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../public/css/form.css">
    <title>Document</title>
</head>
<body>
<div class="form-center">
    <div class="form">
        <h1>Редактирование комнаты № <?= htmlspecialchars($room->roomNumber ?? '') ?></h1>
        <form action="/admin/room/update" method="POST">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <input type="hidden" name="roomId" value="<?= $room->roomId ?? '' ?>">
            <label>Номер комнаты:<input type="text" name="roomNumber" value="<?= htmlspecialchars($room->roomNumber ?? '') ?>" required></label>
            <label>Этаж:<input type="number" name="floor" value="<?= $room->floor ?? '' ?>" required min="1"></label>
                <label>Тип комнаты:
                    <select name="roomType">
                        <option value="male">Мужская</option>
                        <option value="female">Женская</option>
                        <option value="family">Семейная</option>
                    </select>
                </label>

                <label>Количество мест: <input type="number" name="totalBeds" value="<?= $room->totalBeds ?? '' ?>" required min="1"></label>

                <label>Текущее количество жильцов:</label>
                <input type="number" name="numberOfTenants" value="<?= $room->numberOfTenants ?? '0' ?>" min="0" readonly>
                <small style="color: #666;">Это поле обновляется автоматически при заселении/выселении</small>
            <button type="submit" class="btn-save">Сохранить изменения</button>
            <a href="/admin/room/list" class="btn-cancel">Отмена</a>
        </form>
    </div>
</div>
</body>
</html>