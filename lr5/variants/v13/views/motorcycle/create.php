<?php
$errors = $errors ?? [];
$old = $old ?? [];
?>

<h1>Додати мотоцикл</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert--error">
        <strong>Помилки:</strong>
        <ul>
            <?php foreach ($errors as $err): ?>
                <li><?= htmlspecialchars($err) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="index.php?route=motorcycle/create" class="form">
    <div class="form__row">
        <div class="form__group <?= isset($errors['model']) ? 'form__group--error' : '' ?>">
            <label for="m_model" class="form__label">Модель <span class="required">*</span></label>
            <input type="text" id="m_model" name="model" class="form__input"
                   value="<?= htmlspecialchars($old['model'] ?? '') ?>"
                   placeholder="CBR1000RR-R">
            <?php if (isset($errors['model'])): ?>
                <span class="form__error"><?= htmlspecialchars($errors['model']) ?></span>
            <?php endif; ?>
        </div>

        <div class="form__group <?= isset($errors['brand']) ? 'form__group--error' : '' ?>">
            <label for="m_brand" class="form__label">Марка <span class="required">*</span></label>
            <input type="text" id="m_brand" name="brand" class="form__input"
                   value="<?= htmlspecialchars($old['brand'] ?? '') ?>"
                   placeholder="Honda, BMW, Yamaha...">
            <?php if (isset($errors['brand'])): ?>
                <span class="form__error"><?= htmlspecialchars($errors['brand']) ?></span>
            <?php endif; ?>
        </div>
    </div>

    <div class="form__group">
        <label for="m_category" class="form__label">Категорія</label>
        <input type="text" id="m_category" name="category" class="form__input"
               value="<?= htmlspecialchars($old['category'] ?? '') ?>"
               placeholder="Спортивні, Крейзери, Кросові...">
    </div>

    <div class="form__row">
        <div class="form__group <?= isset($errors['price']) ? 'form__group--error' : '' ?>">
            <label for="m_price" class="form__label">Ціна (грн)</label>
            <input type="number" id="m_price" name="price" class="form__input" min="0"
                   value="<?= htmlspecialchars($old['price'] ?? '') ?>"
                   placeholder="950000">
            <?php if (isset($errors['price'])): ?>
                <span class="form__error"><?= htmlspecialchars($errors['price']) ?></span>
            <?php endif; ?>
        </div>

        <div class="form__group <?= isset($errors['engine_cc']) ? 'form__group--error' : '' ?>">
            <label for="m_cc" class="form__label">Об'єм двигуна (cc)</label>
            <input type="number" id="m_cc" name="engine_cc" class="form__input" min="0"
                   value="<?= htmlspecialchars($old['engine_cc'] ?? '') ?>"
                   placeholder="999">
            <?php if (isset($errors['engine_cc'])): ?>
                <span class="form__error"><?= htmlspecialchars($errors['engine_cc']) ?></span>
            <?php endif; ?>
        </div>

        <div class="form__group <?= isset($errors['power_hp']) ? 'form__group--error' : '' ?>">
            <label for="m_hp" class="form__label">Потужність (hp)</label>
            <input type="number" id="m_hp" name="power_hp" class="form__input" min="0"
                   value="<?= htmlspecialchars($old['power_hp'] ?? '') ?>"
                   placeholder="215">
            <?php if (isset($errors['power_hp'])): ?>
                <span class="form__error"><?= htmlspecialchars($errors['power_hp']) ?></span>
            <?php endif; ?>
        </div>
    </div>

    <div class="form__group">
        <label for="m_desc" class="form__label">Опис</label>
        <textarea id="m_desc" name="description" class="form__textarea"
                  placeholder="Розповідь про мотоцикл..."><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
    </div>

    <div class="form__actions">
        <button type="submit" class="btn">Додати</button>
        <a href="index.php?route=motorcycle/list" class="btn btn--secondary">Скасувати</a>
    </div>
</form>
