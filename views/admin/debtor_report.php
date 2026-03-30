<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отчёт по должникам</title>
    <link rel="stylesheet" href="../../public/css/table.css">
</head>
<body>
<h2>Отчёт по должникам</h2>
<a href="/admin/admin_panel">Назад</a>

<?php if (empty($debtors)): ?>
    <p style="color: green; font-size: 1.2em;">Должников нет! Все жильцы оплатили.</p>
<?php else: ?>
    <p><strong>Найдено должников:</strong> <?= count($debtors) ?></p>
<div class="table-container">
    <div class="table-header">
        <div>№ заказа</div>
        <div>Жилец</div>
        <div>Контакты</div>
        <div>Комната</div>
        <div>Период</div>
        <div>Дней просрочки</div>
        <div>Действия</div>
    </div>
        <?php foreach ($debtors as $debtor):
            $checkIn = new DateTime($debtor->checkInDate);
            $today = new DateTime();
            $daysOverdue = $today->diff($checkIn)->days;
            ?>
            <div class="table-row">
                <div><?= $debtor->orderNumber ?></div>
                <div><?= $debtor->tenant->user->surname ?><?= $debtor->tenant->user->name ?></div>
                <div><?= $debtor->tenant->user->phone ?><br><?= $debtor->tenant->user->email ?></div>
                <div>№<?= $debtor->room->roomNumber ?><br><small><?= $debtor->room->building->buildingName ?></small></div>
                <div><?= $debtor->checkInDate ?><br><?= $debtor->checkOutDate ?></div>
                <div class="<?= $daysOverdue > 7 ? 'warning' : '' ?>"><?= $daysOverdue ?> дн.</div>
                <div><a href="/admin/registration/confirm?id=<?= $debtor->registrationID ?>">Зафиксировать оплату</a></div>
            </div>
        <?php endforeach; ?>
<?php endif; ?>
</body>
</html>