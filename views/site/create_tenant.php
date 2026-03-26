<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Создание жильца</title>
</head>
<body>
    <div class="signup-form-center">
        <div class="signup-form">
            <h2>Стань жильцом нашего общежития</h2>
            <form method="post">
                <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                <label>Серия паспорта <input type="number" name="passportSeries"></label>
                <label>Номер паспорта <input type="number" name="passportNumber"></label>
                <label></label>
                <button>Зарегистрировать жильца</button>
            </form>
        </div>
    </div>
</body>
</html>