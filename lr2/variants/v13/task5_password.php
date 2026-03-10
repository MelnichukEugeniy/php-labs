<?php
/**
 * Завдання 5: Генератор + перевірка паролів
 *
 * Генерація пароля та перевірка складності (0–5 балів)
 */

require_once __DIR__ . '/layout.php';


function generatePassword(int $length = 17): string {
    $upper   = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $lower   = "abcdefghijklmnopqrstuvwxyz";
    $digits  = "0123456789";
    $special = "!@#$%^&*()-_=+";
    $all = $upper . $lower . $digits . $special;

    $password = '';
    $password .= $upper[random_int(0, strlen($upper) - 1)];
    $password .= $lower[random_int(0, strlen($lower) - 1)];
    $password .= $digits[random_int(0, strlen($digits) - 1)];
    $password .= $special[random_int(0, strlen($special) - 1)];

    for ($i = 4; $i < $length; $i++) {
        $password .= $all[random_int(0, strlen($all) - 1)];
    }

    return str_shuffle($password);
}


function checkPasswordStrength(string $password): array {
    $checks = [
        'length'  => strlen($password) >= 8,
        'upper'   => preg_match('/[A-Z]/', $password),
        'lower'   => preg_match('/[a-z]/', $password),
        'digit'   => preg_match('/[0-9]/', $password),
        'special' => preg_match('/[!@#$%^&*\(\)\-_=+]/', $password),
    ];

    $score = array_sum($checks); // 0–5

    return [
        'score' => $score,
        'checks' => $checks
    ];
}


$action = $_POST['action'] ?? '';
$password = '';
$result = null;

if ($action === 'generate') {
    $password = generatePassword(17);
    $result = checkPasswordStrength($password);
}
if ($action === 'check') {
    $password = $_POST['password'] ?? '';
    $result = checkPasswordStrength($password);
}

ob_start();
?>
<div class="demo-card">
    <h2>Завдання 5: Генератор паролів</h2>

    <form method="post" class="demo-form">
        <input type="hidden" name="action" value="generate">
        <button type="submit" class="btn-submit">Згенерувати пароль (17 символів)</button>
    </form>

    <form method="post" class="demo-form" style="margin-top: 16px;">
        <input type="hidden" name="action" value="check">
        <label>Перевірити пароль:</label>
        <input type="text" name="password" value="<?= htmlspecialchars($password) ?>">
        <button type="submit" class="btn-submit">Перевірити</button>
    </form>

<?php if ($password): ?>
    <div class="demo-result">
        <h3>Пароль</h3>
        <div class="demo-result-value" style="font-family: monospace;">
            <?= htmlspecialchars($password) ?>
        </div>
    </div>
<?php endif; ?>

<?php if ($result): ?>
    <div class="demo-section">
        <h3>Перевірка складності</h3>
        <table class="demo-table">
            <tr><td>Довжина ≥ 8</td><td><?= $result['checks']['length'] ? '✔' : '✘' ?></td></tr>
            <tr><td>Велика літера</td><td><?= $result['checks']['upper'] ? '✔' : '✘' ?></td></tr>
            <tr><td>Мала літера</td><td><?= $result['checks']['lower'] ? '✔' : '✘' ?></td></tr>
            <tr><td>Цифра</td><td><?= $result['checks']['digit'] ? '✔' : '✘' ?></td></tr>
            <tr><td>Спецсимвол</td><td><?= $result['checks']['special'] ? '✔' : '✘' ?></td></tr>
        </table>

        <div class="demo-result">
            <h3>Складність: <?= $result['score'] ?>/5 балів</h3>
        </div>

        <div class="demo-code">
checkPasswordStrength("<?= htmlspecialchars($password) ?>") → <?= $result['score'] ?>/5
        </div>
    </div>
<?php endif; ?>
</div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, "Рядки: Генератор паролів");
