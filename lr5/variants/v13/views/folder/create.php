<?php
$message = $message ?? '';
$error = $error ?? '';
$folders = $folders ?? [];
?>

<h1>Кабінет механіка</h1>
<p>Введіть Логін — буде створено папку <code>data/users/{Логін}/</code> з підпапками <code>проекти</code>, <code>послуги</code>, <code>запчастини</code>.</p>

<?php if ($message !== ''): ?>
    <div class="alert alert--success"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<?php if ($error !== ''): ?>
    <div class="alert alert--error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST" action="index.php?route=folder/create" class="form">
    <div class="form__row">
        <div class="form__group">
            <label for="folder_login" class="form__label">Логін <span class="required">*</span></label>
            <input type="text" id="folder_login" name="login" class="form__input"
                   value="<?= htmlspecialchars($_POST['login'] ?? '') ?>"
                   placeholder="Латинські літери, цифри, _">
        </div>
        <div class="form__group">
            <label for="folder_password" class="form__label">Пароль <span class="required">*</span></label>
            <input type="password" id="folder_password" name="password" class="form__input"
                   placeholder="Для видалення папки">
        </div>
    </div>

    <div class="form__actions">
        <button type="submit" class="btn">Створити кабінет</button>
        <a href="index.php?route=folder/delete" class="btn btn--secondary">Видалити каталог</a>
    </div>
</form>

<?php if (!empty($folders)): ?>
    <h2>Мої кабінети</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Користувач</th>
                <th>Підпапки</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($folders as $folder): ?>
                <tr>
                    <td><strong><?= htmlspecialchars($folder['name']) ?></strong></td>
                    <td>
                        <?php foreach ($folder['subfolders'] as $sub): ?>
                            <code><?= htmlspecialchars($sub['name']) ?></code> (<?= $sub['files'] ?> файлів)
                            <?php if ($sub !== end($folder['subfolders'])): ?>, <?php endif; ?>
                        <?php endforeach; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
