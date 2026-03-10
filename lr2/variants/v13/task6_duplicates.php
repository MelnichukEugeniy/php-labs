<?php
/**
 * Завдання 6: Пошук унікальних елементів
 *
 * Демонстрація: знаходження елементів, які зустрічаються лише 1 раз
 */
require_once __DIR__ . '/layout.php';


function findUniqueElements(array $arr): array
{
    $counts = array_count_values($arr);
    return array_keys(array_filter($counts, fn($c) => $c === 1));
}


$input = $_POST['array'] ?? '4, 11, 6, 9, 4, 15, 11, 2, 6, 8, 15, 10';
$submitted = isset($_POST['array']);


$arr = array_map('trim', explode(',', $input));
$arr = array_filter($arr, fn($v) => $v !== '');

$unique = findUniqueElements($arr);

ob_start();
?>
<div class="demo-card">
    <h2>Пошук унікальних елементів</h2>
    <p style="color: var(--color-text-muted); margin-top: 0;">
        Елементи, що зустрічаються лише один раз
    </p>

    <form method="post" class="demo-form">
        <div>
            <label for="array">Масив (через кому)</label>
            <input type="text" id="array" name="array" value="<?= htmlspecialchars($input) ?>">
        </div>
        <button type="submit" class="btn-submit">Знайти</button>
    </form>

<?php if (!empty($arr)): ?>
    <div class="demo-section">
        <h3>Вхідний масив</h3>
        <div class="array-display">
            <?php foreach ($arr as $item): ?>
            <span class="array-item <?= in_array($item, $unique) ? 'array-item-unique' : '' ?>">
                <?= htmlspecialchars($item) ?>
            </span>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="demo-result">
        <h3>Унікальні елементи</h3>
        <div class="array-display">
            <?php foreach ($unique as $u): ?>
            <span class="demo-tag demo-tag-success"><?= htmlspecialchars($u) ?></span>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="demo-code">
findUniqueElements([<?= htmlspecialchars(implode(', ', $arr)) ?>])
// Результат: [<?= htmlspecialchars(implode(', ', $unique)) ?>]
    </div>
<?php endif; ?>
</div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Масиви: Унікальні елементи');
