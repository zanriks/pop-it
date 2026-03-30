<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Оплата бронирования</title>
</head>
<body>
<div>
    <div>
        <h2>Оплата бронирования</h2>
        <div>
            <div>
                <p><strong>Номер заказа:</strong> <?= $registration->orderNumber ?></p>
                <p><strong>Дата заезда:</strong> <?= $registration->checkInDate ?></p>
                <p><strong>Дата выезда:</strong> <?= $registration->checkOutDate ?></p>
                <p>К оплате: <?= $payment->accrualAmount?> руб.</p>
            </div>

            <form action="/payment/pay" method="post">
                <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                <input type="hidden" name="registrationId" value="<?= $registration->registrationId ?>">

                <div>
                    <label for="paymentType">Способ оплаты</label>
                    <select name="paymentType" id="paymentType" required>
                        <option value="" disabled selected>Выберите способ...</option>
                        <option value="card">Банковская карта</option>
                        <option value="cash">Наличными при заезде</option>
                    </select>
                </div>

                <div>
                    <button type="submit">
                        Подтвердить оплату
                    </button>
                    <a href="/profile/my_bookings">
                        Отмена
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>