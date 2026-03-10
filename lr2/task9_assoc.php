<?php
/**
 * Завдання 9: Асоціативний масив студентів
 *
 * Демонстрація: ключі — імена студентів, значення — оцінки (1-12)
 * Сортування за іменем або за оцінкою
 */
require_once __DIR__ . '/demo/layout.php';


//Сортує асоціативний масив за іменами (ключами)
function sortByName(array $students): array
{
    ksort($students);
    return $students;
}


//Сортує асоціативний масив за оцінками (значеннями)
function sortByScore(array $students): array
{
    asort($students);
    return $students;
}


$students = [
    "Андрієнко Віталій" => 6,
    "Горбачук Настя" => 12,
    "Демченко Олексій" => 4,
    "Калініченко Яна" => 9,
    "Марченко Денис" => 11,
    "Панасюк Вікторія" => 2,
    "Шевчук Артем" => 8,
];

// Обробка вибору сортування
$sortBy = $_POST['sort'] ?? $_GET['sort'] ?? 'name';
$sorted = $sortBy === 'score' ? sortByScore($students) : sortByName($students);

ob_start();
?>

<div class="demo-card">
    <h2>Асоціативний масив студентів</h2>
    <p style="color: var(--color-text-muted); margin-top: 0;">Сортування за іменем або за оцінкою</p>

    <div class="flex-buttons" style="margin-bottom: 20px; justify-content: center;">
        <form method="post" style="display: inline;">
            <input type="hidden" name="sort" value="name">
            <button type="submit" class="<?= $sortBy === 'name' ? 'btn-submit' : 'btn-secondary' ?>">За іменем</button>
        </form>
        <form method="post" style="display: inline;">
            <input type="hidden" name="sort" value="score">
            <button type="submit" class="<?= $sortBy === 'score' ? 'btn-submit' : 'btn-secondary' ?>">За оцінкою</button>
        </form>
    </div>

    <div class="demo-section" style="border-top: none; padding-top: 0;">
        <h3>Вхідні дані</h3>
        <div class="demo-code" style="text-align: left;">$students = [
<?php foreach ($students as $name => $score): ?>
    "<?= $name ?>" => <?= $score ?>,
<?php endforeach; ?>
];</div>
    </div>

    <div class="demo-section">
        <h3>Відсортовано: <span class="demo-tag demo-tag-primary"><?= $sortBy === 'score' ? 'за оцінкою' : 'за іменем' ?></span></h3>
        <table class="demo-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ім'я <?= $sortBy === 'name' ? '&#8593;' : '' ?></th>
                    <th>Оцінка <?= $sortBy === 'score' ? '&#8593;' : '' ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach ($sorted as $name => $score): ?>
                <tr>
                    <td style="color: var(--color-text-muted);"><?= $i++ ?></td>
                    <td style="font-weight: 600;"><?= htmlspecialchars($name) ?></td>
                    <td><span class="demo-tag demo-tag-success"><?= $score ?></span></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="demo-code"><?= $sortBy === 'score' ? 'sortByScore' : 'sortByName' ?>($students);
// <?= $sortBy === 'score' ? 'asort($students)' : 'ksort($students)' ?></div>
</div>

<?php
$content = ob_get_clean();
renderDemoLayout($content, 'Масиви: Асоціативний');
