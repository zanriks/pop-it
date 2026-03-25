<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
            <div>
                <h1>Каталог комнат</h1>

                <div class="rooms-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
                    <?php foreach ($rooms as $room): ?>
                        <div class="room-card" style="border: 1px solid #ccc; padding: 15px; border-radius: 8px;">
                            <h3>Комната №<?= $room->roomNumber ?></h3>
                            <p><strong>Этаж:</strong> <?= $room->floor ?></p>
                            <p><strong>Тип:</strong> <?= $room->roomType ?></p>
                            <p><strong>Мест:</strong> <?= $room->numberOfTenants ?> / <?= $room->totalBeds ?></p>

                            <!-- Если есть связь с моделью Building -->
                            <p><strong>Корпус:</strong> <?= $room->building->name ?? 'Не указан' ?></p>

                            <a href="/room/view?id=<?= $room->roomId ?>" class="btn">Подробнее</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>
</body>
</html>