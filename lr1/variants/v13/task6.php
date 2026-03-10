<?php
/**
 * Завдання 6: Операції з тризначним числом
 *
 * Демонстрація: mt_rand(), арифметичні операції, масиви, сортування
 */
require_once __DIR__ . '/layout.php';

/**
 * Обчислює суму цифр числа
 */
function sumOfDigits(int $number): int
{
    $d1 = (int) floor($number / 100);
    $d2 = (int) floor(($number % 100) / 10);
    $d3 = $number % 10;
    return $d1 + $d2 + $d3;
}

/**
 * Повертає число в зворотному порядку
 */
function reverseNumber(int $number): int
{
    $d1 = (int) floor($number / 100);
    $d2 = (int) floor(($number % 100) / 10);
    $d3 = $number % 10;
    return $d3 * 100 + $d2 * 10 + $d1;
}

/**
 * Повертає найбільше можливе число з цифр
 */
function maxFromDigits(int $number): int
{
    $d1 = (int) floor($number / 100);
    $d2 = (int) floor(($number % 100) / 10);
    $d3 = $number % 10;
    $digits = [$d1, $d2, $d3];
    rsort($digits);
    return $digits[0] * 100 + $digits[1] * 10 + $digits[2];
}

// Вхідні дані (demo) — тризначне число
$number = mt_rand(100, 999);

// Розбиваємо число на цифри для відображення
$d1 = (int)($number / 100);
$d2 = (int)(($number % 100) / 10);
$d3 = $number % 10;

// Обчислення
$sum = sumOfDigits($number);
$reversed = reverseNumber($number);
$maxNum = maxFromDigits($number);

$content = '<div class="task6-container">
    <div class="card">
        <h3>🎲 Випадкове тризначне число</h3>
        <div class="number-display">' . $number . '</div>
        <div class="digits-row">
            <div class="digit-box">' . $d1 . '</div>
            <div class="digit-box">' . $d2 . '</div>
            <div class="digit-box">' . $d3 . '</div>
        </div>
    </div>

    <div class="card" style="margin-top:20px;">
        <h3>📊 Результати</h3>
        <div class="result-row">
            <div>
                <span>1. Сума цифр</span>
                <div class="func">sumOfDigits(' . $number . ')</div>
            </div>
            <span class="result-value">' . $sum . '</span>
        </div>
        <div class="result-row">
            <div>
                <span>2. В зворотному порядку</span>
                <div class="func">reverseNumber(' . $number . ')</div>
            </div>
            <span class="result-value">' . $reversed . '</span>
        </div>
        <div class="result-row">
            <div>
                <span>3. Найбільше можливе</span>
                <div class="func">maxFromDigits(' . $number . ')</div>
            </div>
            <span class="result-value">' . $maxNum . '</span>
        </div>
    </div>

    <p class="hint">Оновіть сторінку для нового числа 🔄</p>
</div>';

renderVariantLayout($content, 'Завдання 6', 'task6-body');
