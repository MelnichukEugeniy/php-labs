<?php
/**
 * Завдання 2: Сортування міст
 *
 * Демонстрація: робота з рядками, explode, sort, implode
 */
require_once __DIR__ . '/layout.php';

/**
 * Сортує міста в алфавітному порядку
 */
function sortCities(string $input): array
{
    $multiWordCities = [
        'Біла Церква',
        'Івано Франківськ',
        'Кам’янець Подільський',
        'Камянець Подільський',
        'Нова Каховка'
    ];


    $words = array_values(array_filter(array_map('trim', explode(' ', $input))));
    $cities = [];

    for ($i = 0; $i < count($words); $i++) {
        $found = false;

        foreach ($multiWordCities as $multi) {
            $parts = explode(' ', $multi);
            $slice = array_slice($words, $i, count($parts));

            if ($slice === $parts) {
                $cities[] = $multi;
                $i += count($parts) - 1;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cities[] = $words[$i];
        }
    }

    usort($cities, function ($a, $b) {
        $lenA = strlen($a);
        $lenB = strlen($b);

        if ($lenA !== $lenB) {
            return $lenA <=> $lenB;
        }

        return strcoll($a, $b);
    });

    return $cities;
}



$input = $_POST['cities'] ?? '';
$submitted = isset($_POST['cities']);
$defaultCities = 'Суми Львів Дніпро Херсон Запоріжжя Тернопіль Хмельницький Біла Церква';

if (!$submitted) {
    $input = $defaultCities;
}

$sorted = sortCities($input);

ob_start();
?>
<div class="demo-card">
    <h2>Сортування міст</h2>
    <p style="color: var(--color-text-muted); margin-top: 0;">Введіть назви міст через пробіл</p>

    <form method="post" class="demo-form">
        <div>
            <label for="cities">Міста (через пробіл)</label>
            <input type="text" id="cities" name="cities" value="<?= htmlspecialchars($input) ?>" placeholder="Київ Львів Одеса">
        </div>
        <button type="submit" class="btn-submit">Сортувати</button>
    </form>

    <?php if (!empty($sorted)): ?>
    <div class="demo-section">
        <h3>Вхідні дані</h3>
        <div class="array-display">
            <?php foreach (array_filter(array_map('trim', explode(' ', $input))) as $city): ?>
            <span class="array-item"><?= htmlspecialchars($city) ?></span>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="array-arrow">&#8595;</div>

    <div>
        <h3 style="margin: 0 0 12px; font-size: 16px; color: var(--color-success-text);">Відсортовані</h3>
        <div class="array-display">
            <?php foreach ($sorted as $city): ?>
            <span class="array-item array-item-unique"><?= htmlspecialchars($city) ?></span>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="demo-code">sortCities("<?= htmlspecialchars($input) ?>")
// Результат: [<?= htmlspecialchars(implode(', ', array_map(fn($c) => "\"$c\"", $sorted))) ?>]</div>
    <?php endif; ?>
</div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Рядки: Сортування');
