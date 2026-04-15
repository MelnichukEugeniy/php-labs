<?php
$error = $error ?? '';
?>

<h1>Вхід до магазину мотоциклів</h1>
<p class="text-muted">Увійдіть, щоб керувати каталогом мотоциклів, залишати коментарі та переглядати профіль.</p>

<?php if ($error !== ''): ?>
    <div class="alert alert--error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST" action="index.php?route=auth/login" class="form">
    <div class="form__group">
        <label for="login" class="form__label">Логін <span class="required">*</span></label>
        <input type="text" id="login" name="login" class="form__input"
               value="<?= htmlspecialchars($_POST['login'] ?? '') ?>"
               placeholder="Ваш логін">
    </div>

    <div class="form__group">
        <label for="password" class="form__label">Пароль <span class="required">*</span></label>
        <input type="password" id="password" name="password" class="form__input"
               placeholder="Ваш пароль">
    </div>

    <div class="form__actions">
        <button type="submit" class="btn">Увійти</button>
        <a href="index.php?route=auth/register" class="btn btn--secondary">Реєстрація</a>
    </div>
</form>
