<?php
/**
 * Завдання 6: Цикли
 * Таблиця: 10 x 3 комірок різного кольору
 */

require_once dirname(__DIR__, 3) . '/shared/helpers/dev_reload.php';


function generateColorTable(int $rows, int $cols): string
{
    $html = "<div style='display:grid;grid-template-columns:repeat($cols, 80px);grid-gap:10px;width:max-content;margin:50px auto;'>";

    for ($i = 0; $i < $rows; $i++) {
        for ($j = 0; $j < $cols; $j++) {
            $color = sprintf('#%02X%02X%02X', mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
            $html .= "<div style='width:80px;height:80px;background:$color;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:bold;'>$i,$j</div>";
        }
    }

    $html .= "</div>";
    return $html;
}

$rows = 10;
$cols = 3;
$table = generateColorTable($rows, $cols);
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 6 — Таблиця 10x3 комірок</title>
    <link rel="stylesheet" href="../../demo/demo.css">
</head>
<body class="task7-circles-body">
    <header class="header-fixed">
        <div class="header-left">
            <a href="/" class="header-btn">Головна</a>
            <a href="index.php" class="header-btn">← Варіант 10</a>
        </div>
        <div class="header-center"></div>
        <div class="header-right">В-10 / Завд. 6</div>
    </header>

    <?= $table ?>

    <div class="circles-func" style="margin-top:35px; text-align:center;" >generateColorTable(<?= $rows ?>, <?= $cols ?>)</div>
    <div class="circles-counter" style="margin-top:35px; text-align:center;" >🔲 Комірок: <?= $rows * $cols ?></div>

    <?= devReloadScript() ?>
</body>
</html>
