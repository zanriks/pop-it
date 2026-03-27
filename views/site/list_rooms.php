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
<table>
    <thead>
    <tr style="background: #f4f4f4;">
        <th>Здание</th>
        <th>№ Комнаты</th>
        <th>Этаж</th>
        <th>Тип</th>
        <th>Мест (Всего/Занято)</th>
        <th>Статус</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($rooms as $room): ?>
        <tr>
            <td><?= $room->building->name ?? 'Не указано' ?></td>
            <td><strong><?= $room->roomNumber ?></strong></td>
            <td><?= $room->floor ?></td>
            <td><?= $room->roomType ?></td>
            <td><?= $room->numberOfTenants ?> / <?= $room->totalBeds ?></td>
            <td>
                <?php if ($room->numberOfTenants >= $room->totalBeds): ?>
                    <span style="color: red;">Мест нет</span>
                <?php else: ?>
                    <span style="color: green;">Есть места</span>
                <?php endif; ?>
            </td>
            <td>
                <a href="/admin/room/edit?roomId=<?= $room->roomId ?>">Редактировать</a>
                <form action="/admin/room/delete" method="POST" style="display:inline;">
                    <input type="hidden" name="roomId" value="<?= $room->roomId ?>">
                    <button type="submit" onclick="return confirm('Удалить?')">Удалить</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>