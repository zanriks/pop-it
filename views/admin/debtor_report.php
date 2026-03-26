<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отчёт по должникам</title>
</head>
<body>
<h2>Отчёт по должникам</h2>
<a href="/admin/admin_panel">Назад</a>

<?php if (empty($debtors)): ?>
    <p style="color: green; font-size: 1.2em;">Должников нет! Все жильцы оплатили.</p>
<?php else: ?>
    <p><strong>Найдено должников:</strong> <?= count($debtors) ?></p>

    <table>
        <thead>
        <tr>
            <th>№ заказа</th>
            <th>Жилец</th>
            <th>Контакты</th>
            <th>Комната</th>
            <th>Период</th>
            <th>Дней просрочки</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($debtors as $debtor):
            $checkIn = new DateTime($debtor->checkInDate);
            $today = new DateTime();
            $daysOverdue = $today->diff($checkIn)->days;
            ?>
            <tr>
                <td><?= $debtor->orderNumber ?></td>
                <td>
                    <?= $debtor->tenant->user->surname ?>
                    <?= $debtor->tenant->user->name ?>
                </td>
                <td>
                    <?= $debtor->tenant->user->phone ?><br>
                    <?= $debtor->tenant->user->email ?>
                </td>
                <td>
                    №<?= $debtor->room->roomNumber ?><br>
                    <small><?= $debtor->room->building->buildingName ?></small>
                </td>
                <td>
                    <?= $debtor->checkInDate ?><br>
                    <?= $debtor->checkOutDate ?>
                </td>
                <td class="<?= $daysOverdue > 7 ? 'warning' : '' ?>">
                    <?= $daysOverdue ?> дн.
                </td>
                <td>
                    <a href="/admin/registration/confirm?id=<?= $debtor->registrationID ?>" class="btn">
                        Зафиксировать оплату
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
</body>
</html>