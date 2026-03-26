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
                <?= htmlspecialchars($reg->orderNumber) ?><br>
                <small><?= htmlspecialchars($reg->orderDate) ?></small>
            </td>
            <td>
                <?= htmlspecialchars($reg->tenant->user->surname ?? 'N/A') ?>
                <?= htmlspecialchars($reg->tenant->user->name ?? '') ?>
            </td>
            <td>
                №<?= htmlspecialchars($reg->room->roomNumber ?? 'N/A') ?><br>
                <small><?= htmlspecialchars($reg->room->building->buildingName ?? '') ?></small>
            </td>
            <td>
                <?= htmlspecialchars($reg->checkInDate) ?><br>
                <small>↓</small><br>
                <?= htmlspecialchars($reg->checkOutDate) ?>
            </td>
            <td>
                    <span class="status-<?= $reg->status ?>">
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
                <?= $reg->paymentID ? 'Оплачено' : 'Не оплачено' ?>
            </td>
            <td>
                <?php if ($reg->status === 'awaiting'): ?>
                    <form method="POST" action="/admin/registration/confirm" style="display:inline;">
                        <input type="hidden" name="csrf_token" value="<?= app()->auth->generateCSRF() ?>">
                        <input type="hidden" name="id" value="<?= $reg->registrationID ?>">
                        <button type="submit" class="btn btn-confirm">Подтвердить</button>
                    </form>
                <?php endif; ?>

                <?php if ($reg->status === 'confirmed'): ?>
                    <form method="POST" action="/admin/registration/checkin" style="display:inline;">
                        <input type="hidden" name="csrf_token" value="<?= app()->auth->generateCSRF() ?>">
                        <input type="hidden" name="id" value="<?= $reg->registrationID ?>">
                        <button type="submit" class="btn btn-checkin">Заселить</button>
                    </form>
                <?php endif; ?>

                <?php if ($reg->status === 'active'): ?>
                    <form method="POST" action="/admin/registration/checkout" style="display:inline;">
                        <input type="hidden" name="csrf_token" value="<?= app()->auth->generateCSRF() ?>">
                        <input type="hidden" name="id" value="<?= $reg->registrationID ?>">
                        <button type="submit" class="btn btn-checkout" onclick="return confirm('Выселить жильца?')">Выселить</button>
                    </form>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>