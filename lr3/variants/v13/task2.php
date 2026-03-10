<?php
/**
 * Завдання 2: Метод getInfo()
 *
 * Демонстрація: метод об'єкта, що виводить значення властивостей
 */
use LR3\V13\Users;
require_once __DIR__ . '/layout.php';
require_once __DIR__ . '/Users.php';


$user1 = new Users();
$user1->nickname = 'yevhenii';
$user1->name = 'Євгеній';
$user1->surname = 'Мельничук';
$user1->age = '19';
$user1->email = 'yevhenii@gmail.com';
$user1->password = 'pass123';

$user2 = new Users();
$user2->nickname = 'vitalii';
$user2->name = 'Віталій';
$user2->surname = 'Костенко';
$user2->age = '20';
$user2->email = 'vitalii@gmail.com';
$user2->password = 'secure456';

$user3 = new Users();
$user3->nickname = 'denys';
$user3->name = 'Денис';
$user3->surname = 'Плотницький';
$user3->age = '22';
$user3->email = 'denys@gmail.com';
$user3->password = 'myP@ss789';

$users = [
    ['obj' => $user1, 'avatar' => 'avatar-indigo', 'initial' => 'Є'],
    ['obj' => $user2, 'avatar' => 'avatar-green', 'initial' => 'В'],
    ['obj' => $user3, 'avatar' => 'avatar-amber', 'initial' => 'Д'],
];

$labels = ['$user1', '$user2', '$user3'];

ob_start();
?>

<div class="task-header">
    <h1>Метод getInfo()</h1>
    <p>Метод повертає рядок з інформацією про користувача</p>
</div>

<div class="code-block">
<span class="code-comment">// Метод класу Users</span>
<span class="code-keyword">public function</span> <span class="code-method">getInfo</span>(): <span class="code-class">string</span>
{
    <span class="code-keyword">return</span>
    <span class="code-string">"Ім'я: {$this->name} {$this->surname},
    Вік: {$this->age},
    Email: {$this->email},
    Логін: {$this->nickname}"</span>;
}

<span class="code-comment">// Виклик методу</span>
<span class="code-variable">$user1</span><span class="code-arrow">-></span><span class="code-method">getInfo</span>();
</div>

<div class="section-divider">
    <span class="section-divider-text">Результат виклику</span>
</div>

<div class="info-output">
    <div class="info-output-header">
        getInfo() — вивід для кожного об'єкта
    </div>
    <div class="info-output-body">

        <?php foreach ($users as $i => $data): ?>
        <div class="info-output-row">
            <span class="info-output-label">
                <?= $labels[$i] ?>
            </span>
            <span class="info-output-text">
                <?= htmlspecialchars($data['obj']->getInfo()) ?>
            </span>
        </div>
        <?php endforeach; ?>

    </div>
</div>

<div class="section-divider">
    <span class="section-divider-text">Картки користувачів</span>
</div>

<div class="users-grid">
    <?php foreach ($users as $i => $data): ?>
    <div class="user-card">
        <div class="user-card-header">
            <div class="user-card-avatar <?= $data['avatar'] ?>">
                <?= $data['initial'] ?>
            </div>
            <div>
                <div class="user-card-name">
                    <?= htmlspecialchars($data['obj']->name . ' ' . $data['obj']->surname) ?>
                </div>
                <div class="user-card-label">
                    <?= $labels[$i] ?>->getInfo()
                </div>
            </div>
        </div>

        <div class="user-card-body">

            <div class="user-card-field">
                <span class="user-card-field-label">nickname</span>
                <span class="user-card-field-value">
                    <?= htmlspecialchars($data['obj']->nickname) ?>
                </span>
            </div>

            <div class="user-card-field">
                <span class="user-card-field-label">age</span>
                <span class="user-card-field-value">
                    <?= htmlspecialchars($data['obj']->age) ?>
                </span>
            </div>

            <div class="user-card-field">
                <span class="user-card-field-label">email</span>
                <span class="user-card-field-value">
                    <?= htmlspecialchars($data['obj']->email) ?>
                </span>
            </div>

            <div class="user-card-field">
                <span class="user-card-field-label">password</span>
                <span class="user-card-field-value">
                    <?= htmlspecialchars($data['obj']->password) ?>
                </span>
            </div>

        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 2', 'task2-body');