<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/table.css">
    <title>Все бронирования</title>
</head>
<body>
<h2>Все бронирования</h2>
<a href="/admin/admin_panel">Назад</a>

<div class="table-container">
    <div class="table-header">
        <div>Заказ</div>
        <div>Жилец</div>
        <div>Комната</div>
        <div>Даты</div>
        <div>Статус</div>
        <div>Оплата</div>
        <div>Действия</div>
    </div>
    <?php foreach ($registrations as $reg): ?>
        <div class="table-row">
            <div><?= $reg->orderNumber ?><br><small><?= $reg->orderDate ?></small></div>
            <div><?= $reg->tenant->user->surname ?><?= $reg->tenant->user->name ?></div>
            <div>№<?= $reg->room->roomNumber ?><br><small><?= $reg->room->building->buildingName ?></small></div>
            <div><?= $reg->checkInDate ?><br><?= $reg->checkOutDate ?></div>
            <div><span>
                        <?= match($reg->status) {
                            'awaiting' => 'Ожидает',
                            'confirmed' => 'Подтверждено',
                            'active' => 'Заселён',
                            'completed' => 'Завершено',
                            'cancelled' => 'Отменено',
                            default => $reg->status
                        } ?>
                    </span>
            </div>
            <div>
                <?= $reg->paymentId ? 'Оплачено' : 'Не оплачено' ?>
            </div>
            <div>
                <?php if ($reg->status === 'awaiting'): ?>
                    <form method="POST" action="/admin/registration/confirm">
                        <input type="hidden" name="csrf_token" value="<?= app()->auth->generateCSRF() ?>">
                        <input type="hidden" name="id" value="<?= $reg->registrationId ?>">
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
                        <button type="submit">Выселить</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>