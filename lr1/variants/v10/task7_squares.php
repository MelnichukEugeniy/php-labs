<?php
/**
 * Завдання 6.2: 3 червоних квадрати на чорному тлі (розмір зростає)
 */

require_once dirname(__DIR__, 3) . '/shared/helpers/dev_reload.php';

function generateGrowingSquares(int $n): string
{
    $html = "<div style='position:relative;width:100vw;height:100vh;background:#000000;overflow:hidden;'>";

    for ($i = 0; $i < $n; $i++) {
        $size = 50 + $i * 30; 
        $top = mt_rand(5, 85);
        $left = mt_rand(5, 85);
        $opacity = mt_rand(70, 100) / 100;

        $html .= "<div style='
            position:absolute;
            top:{$top}%;
            left:{$left}%;
            width:{$size}px;
            height:{$size}px;
            background-color:#ef4444;
            opacity:{$opacity};
            border-radius:4px;
        '></div>";
    }

    $html .= "</div>";
    return $html;
}

$n = 3; 
$squares = generateGrowingSquares($n);
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 6.2 — Червоні квадрати</title>
    <link rel="stylesheet" href="../../demo/demo.css">
</head>
<body class="task7-circles-body">
    <header class="header-fixed">
        <div class="header-left">
            <a href="/" class="header-btn">Головна</a>
            <a href="index.php" class="header-btn">← Варіант 30</a>
            <a href="/lr1/demo/task7_squares.php?from=v30" class="header-btn header-btn-demo">Demo</a>
        </div>
        <div class="header-center"></div>
        <div class="header-right">В-30 / Завд. 6.2</div>
    </header>

    <?= $squares ?>

    <div class="circles-func" style="margin-top:30px; text-align:center;">
        generateGrowingSquares(<?= $n ?>)
    </div>
    <div class="circles-counter" style="margin-top:10px; text-align:center;">
        🟥 Квадратів: <?= $n ?>
    </div>
    <p class="circles-info" style="text-align:center; margin-top:10px;">
        Оновіть сторінку для нової композиції 🔄
    </p>

    <?= devReloadScript() ?>
</body>
</html>
