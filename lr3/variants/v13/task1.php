<?php
/**
 * Завдання 1: Створення класів та об'єктів
 *
 * Демонстрація: клас Users, створення 3 об'єктів з довільними значеннями
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

ob_start();
?>

<div class="task-header">
    <h1>Створення об'єктів</h1>
    <p>Клас <code>Users</code> з властивостями:
        nickname, name, surname, age, email, password
    </p>
</div>

<div class="code-block">
<span class="code-comment">// Створюємо об'єкт та задаємо властивості</span>
<span class="code-variable">$user1</span> = <span class="code-keyword">new</span> <span class="code-class">Users</span>();
<span class="code-variable">$user1</span><span class="code-arrow">-></span><span class="code-method">nickname</span> = <span class="code-string">'alex'</span>;
<span class="code-variable">$user1</span><span class="code-arrow">-></span><span class="code-method">name</span> = <span class="code-string">'Олександр'</span>;
<span class="code-variable">$user1</span><span class="code-arrow">-></span><span class="code-method">surname</span> = <span class="code-string">'Іваненко'</span>;
<span class="code-variable">$user1</span><span class="code-arrow">-></span><span class="code-method">age</span> = <span class="code-string">'21'</span>;
<span class="code-variable">$user1</span><span class="code-arrow">-></span><span class="code-method">email</span> = <span class="code-string">'alex@gmail.com'</span>;
<span class="code-variable">$user1</span><span class="code-arrow">-></span><span class="code-method">password</span> = <span class="code-string">'pass123'</span>;
</div>

<div class="section-divider">
    <span class="section-divider-text">3 об'єкти</span>
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
                    Об'єкт #<?= $i + 1 ?>
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
renderVariantLayout($content, 'Завдання 1', 'task1-body');