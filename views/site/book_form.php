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
<div class="booking-form">
    <form action="/room/booking" method="POST">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <label>Номер комнаты:</label>
        <input type="name="checkInDate" required>

        <label>Дата заезда:</label>
        <input type="date" name="checkInDate" required>

        <label>Дата выезда:</label>
        <input type="date" name="checkOutDate" required>

        <button type="submit">Забронировать</button>
    </form>
</div>
</body>
</html>