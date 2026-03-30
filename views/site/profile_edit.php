<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование профиля</title>
    <link rel="stylesheet" href="../../public/css/form.css">
</head>
<body>
<div class="form-center">
    <div class="form">
        <h1>Редактирование профиля</h1>

        <?php if (isset($message)): ?>
            <div class="error-message">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <form action="/profile/update?id=<?= $user->id ?>" method="POST" enctype="multipart/form-data">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <input type="hidden" name="id" value="<?= $user->id ?>">

            <div class="form-group">
                <label>Текущий аватар:</label>
                <?php if (!empty($user->avatar)): ?>
                    <div>
                        <img src="<?= app()->route->getUrl($user->avatar) ?>" alt="avatar" width="100" height="100" style="object-fit: cover; border-radius: 50%;">
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label>Новый аватар:</label>
                <input type="file" name="avatar" accept="image/jpeg,image/png,image/gif,image/webp">
                <small>Допустимые форматы: JPG, PNG, GIF, WEBP</small>
            </div>

            <div class="form-group">
                <label>Имя:</label>
                <input type="text" name="name" value="<?= htmlspecialchars($user->name) ?>" required>
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user->email ?? '') ?>" required>
            </div>

            <button type="submit" class="btn-save">Сохранить изменения</button>
            <a href="/profile/user" class="btn-cancel">Отмена</a>
        </form>
    </div>
</div>
</body>
</html>