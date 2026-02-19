<?php
/**
 * Завдання 11: Калькулятор — результати
 */
require_once __DIR__ . '/demo/layout.php';


function my_sin(float $x): float { return sin($x); }
function my_cos(float $x): float { return cos($x); }
function my_tan(float $x): float { return tan($x); }
function my_tg(float $x): string|float {
    $c = cos($x);
    return abs($c) < 1e-10 ? 'Не визначено (cos=0)' : sin($x)/$c;
}
function my_pow(float $x, float $y): float { return pow($x, $y); }
function my_factorial(int $n): string|int {
    if ($n < 0) return 'Не визначено (x<0)';
    if ($n > 20) return 'Занадто велике (x>20)';
    return $n <= 1 ? 1 : $n * my_factorial($n-1);
}


$x = isset($_POST['x']) ? (float)$_POST['x'] : null;
$y = isset($_POST['y']) ? (float)$_POST['y'] : null;

if ($x === null || $y === null) {
    header('Location: task11_calc.php');
    exit;
}


$results = [
    ['func'=>'sin(x)', 'expr'=>"sin($x)", 'value'=>my_sin($x)],
    ['func'=>'cos(x)', 'expr'=>"cos($x)", 'value'=>my_cos($x)],
    ['func'=>'tg(x)', 'expr'=>"tan($x)", 'value'=>my_tan($x)],
    ['func'=>'my_tg(x)', 'expr'=>"sin($x)/cos($x)", 'value'=>my_tg($x)],
    ['func'=>'x^y', 'expr'=>"$x^$y", 'value'=>my_pow($x,$y)],
    ['func'=>'x!', 'expr'=>intval($x).'!', 'value'=>my_factorial(intval($x))],
];

ob_start();
?>
<div class="demo-card demo-card-wide">
    <h2>Результати обчислень</h2>

    <div style="display:flex;gap:16px;margin-bottom:20px;">
        <div class="demo-result demo-result-info"><h3>X</h3><div class="demo-result-value"><?= htmlspecialchars((string)$x) ?></div></div>
        <div class="demo-result demo-result-info"><h3>Y</h3><div class="demo-result-value"><?= htmlspecialchars((string)$y) ?></div></div>
    </div>

    <table class="calc-table">
        <thead><tr><th>Функція</th><th>Вираз</th><th>Результат</th></tr></thead>
        <tbody>
        <?php foreach($results as $r): ?>
            <tr>
                <td style="font-weight:600;"><?= htmlspecialchars($r['func']) ?></td>
                <td style="color: var(--color-text-muted);"><?= htmlspecialchars($r['expr']) ?></td>
                <td style="font-weight:600;color:var(--color-primary);">
                    <?php
                    echo is_string($r['value'])
                        ? '<span style="color:var(--color-error);font-weight:normal;">'.htmlspecialchars($r['value']).'</span>'
                        : round($r['value'],10);
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div class="flex-buttons" style="margin-top:24px;">
        <a href="task11_calc.php?x=<?= urlencode((string)$x) ?>&y=<?= urlencode((string)$y) ?>" class="btn-secondary">Назад до калькулятора</a>
        <a href="task11_calc.php" class="btn-submit" style="color:white;text-decoration:none;">Нові значення</a>
    </div>
</div>
<?php
$content = ob_get_clean();
renderDemoLayout($content, 'Функції: Результати');
