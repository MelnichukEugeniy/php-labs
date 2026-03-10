<?php
/**
 * Завдання 11: Калькулятор — форма введення
 */
require_once __DIR__ . '/layout.php';

$xDefault = 1.5;
$yDefault = 3;

ob_start();
?>
<div class="demo-card">
    <h2>Калькулятор функцій</h2>
    <p style="color: var(--color-text-muted); margin-top: 0;">Функції: sin, cos, tg, my_tg, x^y, x!</p>

    <form method="post" action="task11_result.php" class="demo-form">
        <div class="form-row">
            <div>
                <label for="x">Значення X</label>
                <input type="number" id="x" name="x" step="any" value="<?= htmlspecialchars($_GET['x'] ?? $xDefault) ?>" placeholder="Введіть X" required>
            </div>
            <div>
                <label for="y">Значення Y</label>
                <input type="number" id="y" name="y" step="any" value="<?= htmlspecialchars($_GET['y'] ?? $yDefault) ?>" placeholder="Введіть Y" required>
            </div>
        </div>
        <button type="submit" class="btn-submit">Обчислити</button>
    </form>

    <div class="demo-section">
        <h3>Доступні функції</h3>
        <table class="demo-table">
            <thead>
                <tr>
                    <th>Функція</th>
                    <th>Опис</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>sin(x)</td><td>Синус X (радіани)</td></tr>
                <tr><td>cos(x)</td><td>Косинус X (радіани)</td></tr>
                <tr><td>tg(x)</td><td>Тангенс X (вбудований)</td></tr>
                <tr><td>my_tg(x)</td><td>Тангенс X через sin/cos</td></tr>
                <tr><td>x^y</td><td>X піднесене до степеня Y</td></tr>
                <tr><td>x!</td><td>Факторіал X (цілі ≥ 0)</td></tr>
            </tbody>
        </table>
    </div>
</div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Функції: Калькулятор');
