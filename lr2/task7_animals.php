<?php
/**
 * Завдання 7: Генератор імен тварин
 *
 * Генерація імен із заданих складів
 */
require_once __DIR__ . '/demo/layout.php';


function generateAnimalName(array $syllables, int $syllablesPerName = 2): string
{
    $name = '';
    for ($i = 0; $i < $syllablesPerName; $i++) {
        $name .= $syllables[array_rand($syllables)];
    }

    return strtoupper(substr($name, 0, 1)) . substr($name, 1);
}


function generateNames(array $syllables, int $count = 5, int $syllablesPerName = 2): array
{
    $result = [];
    for ($i = 0; $i < $count; $i++) {
        $result[] = generateAnimalName($syllables, $syllablesPerName);
    }
    return $result;
}


$syllablesInput = $_POST['syllables'] ?? "рон ка ві бу зен мі тай лу по шар";
$count = (int)($_POST['count'] ?? 5);
$syllablesPerName = (int)($_POST['syllables_per_name'] ?? 2);

$syllables = array_filter(array_map('trim', explode(' ', $syllablesInput)));
$names = generateNames($syllables, $count, $syllablesPerName);

ob_start();
?>
<div class="demo-card">
    <h2>Генератор імен тварин</h2>
    <p style="color: var(--color-text-muted); margin-top: 0;">
        Генерація випадкових імен із заданих складів
    </p>

    <form method="post" class="demo-form">
        <div>
            <label for="syllables">Склади (через пробіл)</label>
            <input type="text" id="syllables" name="syllables" value="<?= htmlspecialchars($syllablesInput) ?>">
        </div>

        <div class="form-row">
            <div>
                <label for="count">Кількість імен</label>
                <input type="number" id="count" name="count" value="<?= $count ?>">
            </div>
            <div>
                <label for="syllables_per_name">Складів на імʼя</label>
                <input type="number" id="syllables_per_name" name="syllables_per_name" value="<?= $syllablesPerName ?>">
            </div>
        </div>

        <button type="submit" class="btn-submit">Згенерувати</button>
    </form>

    <div class="demo-section">
        <h3>Склади</h3>
        <div class="array-display">
            <?php foreach ($syllables as $s): ?>
                <span class="array-item"><?= htmlspecialchars($s) ?></span>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="array-arrow">↓</div>

    <div class="demo-section">
        <h3>Згенеровані імена</h3>
        <div class="array-display">
            <?php foreach ($names as $n): ?>
                <span class="array-item array-item-unique"><?= htmlspecialchars($n) ?></span>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="demo-code">
generateNames(["рон","ка","ві","бу","зен","мі","тай","лу","по","шар"], 5, 2)
// Приклад результату: [<?= htmlspecialchars(implode(', ', $names)) ?>]
    </div>
</div>
<?php
$content = ob_get_clean();
renderDemoLayout($content, 'Масиви: Генератор імен');
