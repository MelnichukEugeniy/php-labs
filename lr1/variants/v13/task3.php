<?php
/**
 * Завдання 3: Конвертер валют (USD → UAH)
 *
 * Демонстрація: змінні, арифметичні операції, функції
 */
require_once __DIR__ . '/layout.php';

/**
 * Конвертує долари в гривні
 */
function convertUsdToUah(float $usd, float $rate): int
{
    return (int) floor($usd * $rate);
}

/**
 * Форматує результат конвертації
 */
function formatConversionResult(float $usd, int $uah): string
{
    return "{$usd} долар = {$uah} грн";
}

// Вхідні дані (demo)
$usd = 100;
$rate = 41.50;

// Розрахунок
$uah = convertUsdToUah($usd, $rate);
$result = formatConversionResult($usd, $uah);

$content = '<div class="card">
    <h2>💵 Конвертер USD → UAH</h2>
    <p><strong>Курс:</strong> 1 USD = ' . $rate . ' грн</p>
    <div class="result">' . $result . '</div>
    <p class="info">Функція: convertUsdToUah(' . $usd . ', ' . $rate . ') = ' . $uah . '</p>
</div>';

renderVariantLayout($content, 'Завдання 3', 'task3-body');
