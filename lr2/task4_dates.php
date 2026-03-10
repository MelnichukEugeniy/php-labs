<?php
/**
 * Завдання 4: Різниця дат
 *
 * Обчислення кількості днів між двома датами у форматі ДД-ММ-РРРР
 */

require_once __DIR__ . '/demo/layout.php';


function isValidDate(string $date): bool {
    $d = DateTime::createFromFormat('d-m-Y', $date);
    return $d && $d->format('d-m-Y') === $date;
}


function dateDifference(string $date1, string $date2): int|false {
    $d1 = DateTime::createFromFormat('d-m-Y', $date1);
    $d2 = DateTime::createFromFormat('d-m-Y', $date2);

    if (!$d1 || !$d2) {
        return false;
    }

    // Абсолютна різниця (без мінуса)
    return abs($d1->diff($d2)->days);
}

// Тестові дані з умви завдання
$date1 = $_POST['date1'] ?? "14-02-2024";
$date2 = $_POST['date2'] ?? "30-10-2025";
$submitted = isset($_POST['date1']);

$error = '';
$days = null;

if ($submitted) {
    if (!isValidDate($date1)) {
        $error = "Перша дата має невірний формат (ДД-ММ-РРРР)";
    } elseif (!isValidDate($date2)) {
        $error = "Друга дата має невірний формат (ДД-ММ-РРРР)";
    } else {
        $days = dateDifference($date1, $date2);
    }
}

ob_start();
?>
<div class="demo-card">
    <h2>Різниця дат</h2>
    <p style="color: var(--color-text-muted); margin-top: 0;">
        Обчислення кількості днів між двома датами
    </p>

    <form method="post" class="demo-form">
        <div class="form-row">
            <div>
                <label for="date1">Дата 1 (ДД-ММ-РРРР)</label>
                <input type="text" id="date1" name="date1" value="<?= htmlspecialchars($date1) ?>">
            </div>
            <div>
                <label for="date2">Дата 2 (ДД-ММ-РРРР)</label>
                <input type="text" id="date2" name="date2" value="<?= htmlspecialchars($date2) ?>">
            </div>
        </div>
        <button type="submit" class="btn-submit">Обчислити</button>
    </form>

<?php if ($error): ?>
    <div class="demo-result demo-result-error">
        <h3>Помилка</h3>
        <div class="demo-result-value"><?= htmlspecialchars($error) ?></div>
    </div>

<?php elseif ($days !== null): ?>
    <div class="demo-result">
        <h3>Результат</h3>
        <div class="demo-result-value"><?= $days ?> днів</div>
    </div>

    <div class="demo-section">
        <h3>Деталі</h3>
        <table class="demo-table">
            <tr>
                <td><b>Дата 1</b></td>
                <td><span class="demo-tag demo-tag-primary"><?= htmlspecialchars($date1) ?></span></td>
            </tr>
            <tr>
                <td><b>Дата 2</b></td>
                <td><span class="demo-tag demo-tag-primary"><?= htmlspecialchars($date2) ?></span></td>
            </tr>
            <tr>
                <td><b>Різниця</b></td>
                <td><span class="demo-tag demo-tag-success"><?= $days ?> днів</span></td>
            </tr>
        </table>
    </div>

    <div class="demo-code">
dateDifference("<?= $date1 ?>", "<?= $date2 ?>") → <?= $days ?>
    </div>
<?php endif; ?>
</div>
<?php
$content = ob_get_clean();
renderDemoLayout($content, "Рядки: Різниця дат");
