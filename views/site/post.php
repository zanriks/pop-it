<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../public/css/table.css">
    <title>Главная</title>
</head>
<body>
    <main>
        <section class="main-banner">
            <div class="banner-image">
                <img src="https://travel.yandex.ru/journal/chetyre-samyh-krasivyh-v-mire-morya/" alt="sea">
            </div>
        </section>
        <section class="main-info">
            <div >
                <h1>Наши преимущества</h1>
                <div >
                    <div class="info-card">qeqweqw</div>
                    <div class="info-card">zxczxzxc</div>
                    <div class="info-card">asdsaasd</div>
                    <div class="info-card">erteterte</div>
                </div>
            </div>
        </section>
        <section class="catalog-rooms">
            <div class="table-container">
                <div class="table-header">
                    <div>ID здания</div>
                    <div>Название здания</div>
                    <div>№</div>
                    <div>Этаж</div>
                    <div>Тип</div>
                    <div>Мест</div>
                    <div>Действия</div>
                </div>

                <?php if (!empty($rooms)): ?>
                    <?php foreach ($rooms as $room): ?>
                        <div class="table-row">
                            <div><?= $room->buildingId ?></div>
                            <div><?= $room->buildingName ?? 'ID: '.$room->buildingId ?></div>
                            <div><?= $room->roomNumber ?></div>
                            <div><?= $room->floor ?></div>
                            <div><?= $room->roomType ?></div>
                            <div><?= $room->numberOfTenants ?> / <?= $room->totalBeds ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="table-row">
                        <div>Комнаты не найдены</div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>
</body>
</html>