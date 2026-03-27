<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Бронирование комнаты</title>
</head>
<body>
<h2>Бронирование комнаты</h2>

<?php if (!empty($errors)): ?>
    <div>
        <?php foreach ($errors as $field => $error): ?>
            <p><?= htmlspecialchars($error) ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post">
    <input name="csrf_token" type="hidden" value="<?= app()->auth->generateCSRF() ?>">
    <label>Комната:</label>
    <select name="roomId" required>
        <option value="">Выберите комнату</option>
        <?php foreach ($rooms as $room): ?>
            <option value="<?= $room->roomId ?>">
                <?= $room->roomNumber ?> комната <?= $room->totalBeds - $room->numberOfTenants ?> мест свободно
            </option>
        <?php endforeach; ?>
    </select>
    <label>Дата заезда:</label>
    <input type="date" name="checkInDate" required>

    <label>Дата Выезда:</label>
    <input type="date" name="checkOutDate" required>
    <button type="submit">Забронировать</button>
</form>
</body>
</html>