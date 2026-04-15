<?php
$motorcycles = $motorcycles ?? [];
?>

<h1>Каталог мотоциклів</h1>
<p>Колекція мотоциклів магазину. CRUD через PDO (prepared statements).</p>

<div class="form__actions" style="margin-bottom: 20px">
    <a href="index.php?route=motorcycle/create" class="btn">Додати мотоцикл</a>
</div>

<?php if (empty($motorcycles)): ?>
    <p class="text-muted">Мотоциклів ще немає.</p>
<?php else: ?>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Модель</th>
                <th>Марка</th>
                <th>Категорія</th>
                <th>Ціна (грн)</th>
                <th>Об'єм (cc)</th>
                <th>Потужність (hp)</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($motorcycles as $m): ?>
                <tr>
                    <td><?= (int)$m['id'] ?></td>
                    <td><?= htmlspecialchars($m['model']) ?></td>
                    <td><?= htmlspecialchars($m['brand']) ?></td>
                    <td><?= htmlspecialchars($m['category']) ?></td>
                    <td><?= number_format((int)$m['price'], 0, '.', ' ') ?></td>
                    <td><?= (int)$m['engine_cc'] ?></td>
                    <td><?= (int)$m['power_hp'] ?></td>
                    <td class="table__actions">
                        <a href="index.php?route=motorcycle/edit&id=<?= (int)$m['id'] ?>" class="btn btn--small">Редагувати</a>
                        <form method="POST" action="index.php?route=motorcycle/delete" style="display:inline"
                              onsubmit="return confirm('Видалити мотоцикл?')">
                            <input type="hidden" name="id" value="<?= (int)$m['id'] ?>">
                            <button type="submit" class="btn btn--small btn--danger">Видалити</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
