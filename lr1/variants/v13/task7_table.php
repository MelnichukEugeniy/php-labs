<?php
/**
 * Завдання 7.1: Кольорова таблиця n×n
 *
 * Демонстрація: цикли for, функції, генерація HTML/CSS
 */

/**
 * Генерує HTML таблицю n×n з випадковими кольорами
 */
function generateColorTable(int $n): string
{
    $html = "<table class='chessboard'>";
    for ($i = 0; $i < $n; $i++) {
        $html .= "<tr>";
        for ($j = 0; $j < $n; $j++) {
            $color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            $html .= "<td style='background-color:$color;'></td>";
        }
        $html .= "</tr>";
    }
    $html .= "</table>";
    return $html;
}

require_once dirname(__DIR__, 3) . '/shared/helpers/paths.php';

// Параметри (demo)
$n = 5;

// Генеруємо таблицю
$table = generateColorTable($n);
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 6.1 — Кольорова таблиця — Варіант 13 ЛР1</title>
    <link rel="stylesheet" href="<?= webPath(dirname(__DIR__, 3) . '/shared/css/base.css') ?>">
    <link rel="stylesheet" href="<?= webPath(dirname(__DIR__, 2) . '/demo/demo.css') ?>">
</head>
<body class="task7-table-body body-with-header">
    <header class="header-fixed">
        <div class="header-left">
            <a href="/" class="header-btn">Головна</a>
            <a href="index.php" class="header-btn">← Варіант 13</a>
            <a href="/lr1/demo/task7_table.php?from=v13" class="header-btn header-btn-demo">Demo</a>
        </div>
        <div class="header-center"></div>
        <div class="header-right"><span class="header-variant-label">В-13</span> Завд. 6.1</div>
    </header>

    <h1>🎨 Кольорова таблиця <?= $n ?>×<?= $n ?></h1>
    <div class="params">generateColorTable(<?= $n ?>)</div>

    <?= $table ?>

    <p class="info" style="color:rgba(255,255,255,0.8);margin-top:20px;">Оновіть сторінку для нових кольорів 🔄</p>
</body>
</html>
