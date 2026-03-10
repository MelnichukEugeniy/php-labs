<?php
/**
 * Завдання 2: Конвертер валют (UAH → USD)
 *
 * 12400 грн → долари, курс 42.60
 */
require_once __DIR__ . '/layout.php';

function convertUahToUsd(float $uah, float $rate): float
{
    return round($uah / $rate, 2);
}

// Вхідні дані
$uah = 12400;
$rate = 42.60;

$usd = convertUahToUsd($uah, $rate);

$content = '<div class="card">
    <h2>💵 Конвертер UAH → USD</h2>
    <p><strong>Курс:</strong> 1 долар = ' . $rate . ' грн</p>
    <div class="result">' . $uah . ' грн. можна обміняти на <strong>' . $usd . '</strong> долар</div>
    <p class="info">convertUahToUsd(' . $uah . ', ' . $rate . ') = ' . $usd . '</p>
</div>';

renderVariantLayout($content, 'Завдання 2', 'task3-body');
