<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/table.css">
    <title>Мои бронирования</title>
</head>
<body>
<h2>Мои бронирования</h2>

<a href="/">На главную</a>
<a href="/tenant/booking/create">Новая бронь</a>

<?php if (empty($bookings)): ?>
    <div>
        <p>У вас пока нет бронирований</p>
        <a href="/tenant/booking/create">Забронировать комнату</a>
    </div>
<?php else: ?>
<div class="table-container">
    <div class="table-header">
        <div>№ заказа</div>
        <div>Комната</div>
        <div>Здание</div>
        <div>Заезд / Выезд</div>
        <div>Статус</div>
        <div>Дата заказа</div>
        <div>Действия</div>
    </div>
</div>
        <?php foreach ($bookings as $booking): ?>
            <div class="table-row">
                <div><?= $booking->orderNumber ?></div>
                <div>№<?= $booking->room->roomNumber ?><br><small><?= $booking->room->roomType ?></small></div>
                <div><?= $booking->room->building->buildingName ?></div>
                <div><?= $booking->checkInDate ?><br><?= $booking->checkOutDate?></div>
                <div>
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
                </div>
                <div><?= $booking->orderDate ?></div>
                <div>
                    <?php if ($booking->status === 'awaiting'): ?>
                        <form method="POST" action="/tenant/booking/cancel">
                            <input type="hidden" name="csrf_token" value="<?= app()->auth->generateCSRF() ?>">
                            <input type="hidden" name="registrationId" value="<?= $booking->registrationId ?>">
                            <button type="submit" onclick="return confirm('Отменить бронь?')">Отменить</button>
                        </form>
                        <a href="/payment/pay?id=<?= $booking->registrationId ?>">Оплатить</a>
                    <?php elseif ($booking->status === 'confirmed'): ?>
                        <span style="color:green">Ожидает заселения</span>
                    <?php elseif ($booking->status === 'active'): ?>
                        <span style="color:blue">Вы проживаете</span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
<?php endif; ?>
</body>
</html>