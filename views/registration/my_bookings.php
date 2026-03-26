<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои бронирования</title>
</head>
<body>
<h2>Мои бронирования</h2>

<a href="/">На главную</a>
<a href="/tenant/booking/create">Новая бронь</a>
<a href="/payment/pay">Оплата бронирования</a>

<?php if (empty($bookings)): ?>
    <div class="empty">
        <p>У вас пока нет бронирований</p>
        <a href="/tenant/booking/create">Забронировать комнату</a>
    </div>
<?php else: ?>
    <table>
        <thead>
        <tr>
            <th>№ заказа</th>
            <th>Комната</th>
            <th>Здание</th>
            <th>Заезд / Выезд</th>
            <th>Статус</th>
            <th>Дата заказа</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($bookings as $booking): ?>
            <tr>
                <td><?= $booking->orderNumber ?></td>
                <td>
                    №<?= $booking->room->roomNumber ?><br>
                    <small><?= $booking->room->roomType ?></small>
                </td>
                <td><?= $booking->room->building->buildingName ?></td>
                <td>
                    <?= $booking->checkInDate ?><br>
                    <?= $booking->checkOutDate?>
                </td>
                <td>
                        <span class="status-<?= $booking->status ?>">
                            <?= match($booking->status) {
                                'awaiting' => 'Ожидает',
                                'confirmed' => 'Подтверждено',
                                'active' => 'Заселён',
                                'completed' => 'Завершено',
                                'cancelled' => 'Отменено',
                                default => $booking->status
                            } ?>
                        </span>
                </td>
                <td><?= $booking->orderDate ?></td>
                <td>
                    <?php if ($booking->status === 'awaiting'): ?>
                        <form method="POST" action="/tenant/booking/cancel" style="display:inline;">
                            <input type="hidden" name="csrf_token" value="<?= app()->auth->generateCSRF() ?>">
                            <input type="hidden" name="id" value="<?= $booking->registrationID ?>">
                            <button type="submit" class="btn btn-cancel" onclick="return confirm('Отменить бронь?')">Отменить</button>
                        </form>
                        <a href="/payment/pay?id=<?= $booking->registrationID ?>" class="btn btn-pay">Оплатить</a>
                    <?php elseif ($booking->status === 'confirmed'): ?>
                        <span style="color:green">Ожидает заселения</span>
                    <?php elseif ($booking->status === 'active'): ?>
                        <span style="color:blue">Вы проживаете</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
</body>
</html>