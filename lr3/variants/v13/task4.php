<?php
/**
 * Завдання 4: Клонування об'єктів
 *
 * Демонстрація: __clone() задає значення за замовчанням при копіюванні
 */
use LR3\V13\Users;
require_once __DIR__ . '/layout.php';
require_once __DIR__ . '/Users.php';

// Створюємо оригінальний об'єкт
$user3 = new Users(
    'Дмитро', 
    'dmytro@gmail.com', 
    'dmytro', 
    'myP@ss789', 
    'Петренко', 
    25
);

// Клонуємо — __clone() змінює частину даних
$user4 = clone $user3;

ob_start();
?>

<div class="task-header">
    <h1>Клонування об'єктів Users</h1>
    <p>Метод <code>__clone()</code> задає значення за замовчанням при копіюванні об'єкта</p>
</div>

<div class="comparison-wrapper">
    <div class="users-grid">
        <!-- Оригінал -->
        <div class="user-card">
            <div class="user-card-header">
                <div class="user-card-avatar avatar-amber">Д</div>
                <div>
                    <div class="user-card-name"><?= htmlspecialchars($user3->name . ' ' . $user3->surname) ?></div>
                    <div class="user-card-label">$user3 <span class="user-card-badge badge-constructor">original</span></div>
                </div>
            </div>
            <div class="user-card-body">
                <div class="user-card-field"><span class="user-card-field-label">nickname</span><span class="user-card-field-value"><?= htmlspecialchars($user3->nickname) ?></span></div>
                <div class="user-card-field"><span class="user-card-field-label">age</span><span class="user-card-field-value"><?= $user3->age ?></span></div>
                <div class="user-card-field"><span class="user-card-field-label">email</span><span class="user-card-field-value"><?= htmlspecialchars($user3->email) ?></span></div>
                <div class="user-card-field"><span class="user-card-field-label">password</span><span class="user-card-field-value"><?= htmlspecialchars($user3->password) ?></span></div>
            </div>
        </div>

        <!-- Клон -->
        <div class="user-card">
            <div class="user-card-header">
                <div class="user-card-avatar avatar-rose">Д</div>
                <div>
                    <div class="user-card-name"><?= htmlspecialchars($user4->name . ' ' . $user4->surname) ?></div>
                    <div class="user-card-label">$user4 <span class="user-card-badge badge-clone">clone</span></div>
                </div>
            </div>
            <div class="user-card-body">
                <div class="user-card-field"><span class="user-card-field-label">nickname</span><span class="user-card-field-value"><?= htmlspecialchars($user4->nickname) ?></span></div>
                <div class="user-card-field"><span class="user-card-field-label">age</span><span class="user-card-field-value"><?= $user4->age ?></span></div>
                <div class="user-card-field"><span class="user-card-field-label">email</span><span class="user-card-field-value"><?= htmlspecialchars($user4->email) ?></span></div>
                <div class="user-card-field"><span class="user-card-field-label">password</span><span class="user-card-field-value"><?= htmlspecialchars($user4->password) ?></span></div>
            </div>
        </div>
    </div>
</div>

<div class="section-divider">
    <span class="section-divider-text">getInfo() порівняння</span>
</div>

<div class="info-output">
    <div class="info-output-header">Результат getInfo() для оригіналу та клону</div>
    <div class="info-output-body">
        <div class="info-output-row">
            <span class="info-output-label">$user3</span>
            <span class="info-output-text"><?= htmlspecialchars($user3->getInfo()) ?></span>
        </div>
        <div class="info-output-row">
            <span class="info-output-label">$user4</span>
            <span class="info-output-text"><?= htmlspecialchars($user4->getInfo()) ?></span>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 4', 'task4-body');