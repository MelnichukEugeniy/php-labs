<?php
/**
 * Завдання 7.2: Випадкові червоні квадрати на чорному тлі
 *
 * Демонстрація: цикли, функції, CSS positioning, mt_rand()
 */

/**
 * Генерує HTML з випадковими квадратами
 */
function generateRandomSquares(int $n): string
{
    $html = "<div style='position:relative;width:100vw;height:100vh;background:black;'>";

    for ($i = 0; $i < $n; $i++) {
        $size = mt_rand(20, 100);
        $top = mt_rand(0, 90);
        $left = mt_rand(0, 90);
        $opacity = mt_rand(70, 100) / 100;

        $html .= "<div class='square' style='
            position:absolute;
            width:{$size}px;
            height:{$size}px;
            top:{$top}%;
            left:{$left}%;
            background:red;
            opacity:{$opacity};
        '></div>";
    }

    $html .= "</div>";
    return $html;
}

require_once dirname(__DIR__, 3) . '/shared/helpers/paths.php';

// Кількість квадратів (demo)
$n = 15;

// Генеруємо
$squares = generateRandomSquares($n);
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 6.2 — Червоні квадрати — Варіант 13 ЛР1</title>
    <link rel="stylesheet" href="<?= webPath(dirname(__DIR__, 3) . '/shared/css/base.css') ?>">
    <link rel="stylesheet" href="<?= webPath(dirname(__DIR__, 2) . '/demo/demo.css') ?>">
</head>
<body class="task7-circles-body">
    <header class="header-fixed">
        <div class="header-left">
            <a href="/" class="header-btn">Головна</a>
            <a href="index.php" class="header-btn">← Варіант 13</a>
            <a href="/lr1/demo/task7_squares.php?from=v13" class="header-btn header-btn-demo">Demo</a>
        </div>
        <div class="header-center"></div>
        <div class="header-right"><span class="header-variant-label">В-13</span> Завд. 6.2</div>
    </header>

    <?= $squares ?>

    <div class="circles-func">generateRandomSquares(<?= $n ?>)</div>
    <div class="circles-counter">🟥 Квадратів: <?= $n ?></div>
    <p class="circles-info">Оновіть сторінку для нової композиції 🔄</p>
</body>
</html>
