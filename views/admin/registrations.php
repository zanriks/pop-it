<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Все бронирования</title>
</head>
<body>
<h2>Все бронирования</h2>
<a href="/admin/admin_panel">Назад</a>

<table>
    <thead>
    <tr>
        <th>Заказ</th>
        <th>Жилец</th>
        <th>Комната</th>
        <th>Даты</th>
        <th>Статус</th>
        <th>Оплата</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($registrations as $reg): ?>
        <tr>
            <td>
                <?= $reg->orderNumber ?><br>
                <small><?= $reg->orderDate ?></small>
            </td>
            <td>
                <?= $reg->tenant->user->surname ?>
                <?= $reg->tenant->user->name ?>
            </td>
            <td>
                №<?= $reg->room->roomNumber ?><br>
                <small><?= $reg->room->building->buildingName ?></small>
            </td>
            <td>
                <?= $reg->checkInDate ?><br>
                <?= $reg->checkOutDate ?>
            </td>
            <td>
                    <span>
                        <?= match($reg->status) {
                            'awaiting' => 'Ожидает',
                            'confirmed' => 'Подтверждено',
                            'active' => 'Заселён',
                            'completed' => 'Завершено',
                            'cancelled' => 'Отменено',
                            default => $reg->status
                        } ?>
                    </span>
            </td>
            <td>
                <?= $reg->paymentId ? 'Оплачено' : 'Не оплачено' ?>
            </td>
            <td>
                <?php if ($reg->status === 'awaiting'): ?>
                    <form method="POST" action="/admin/registration/confirm">
                        <input type="hidden" name="csrf_token" value="<?= app()->auth->generateCSRF() ?>">
                        <input type="hidden" name="registrationId" value="<?= $reg->registrationId ?>">
                        <button type="submit">Подтвердить</button>
                    </form>
                <?php endif; ?>

                <?php if ($reg->status === 'confirmed'): ?>
                    <form method="POST" action="/admin/registration/checkin">
                        <input type="hidden" name="csrf_token" value="<?= app()->auth->generateCSRF() ?>">
                        <input type="hidden" name="registrationId" value="<?= $reg->registrationId ?>">
                        <button type="submit">Заселить</button>
                    </form>
                <?php endif; ?>

                <?php if ($reg->status === 'active'): ?>
                    <form method="POST" action="/admin/registration/checkout">
                        <input type="hidden" name="csrf_token" value="<?= app()->auth->generateCSRF() ?>">
                        <input type="hidden" name="registrationId" value="<?= $reg->registrationId ?>">
                        <button type="submit" onclick="return confirm('Выселить жильца?')">Выселить</button>
                    </form>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>