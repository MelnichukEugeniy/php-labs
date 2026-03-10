<?php
/**
 * Завдання 3: Конструктор
 *
 * Демонстрація: створення об'єктів через конструктор
 */
use LR3\V13\Users;
require_once __DIR__ . '/layout.php';
require_once __DIR__ . '/Users.php';

$user1 = new Users('Євгеній','yevhenii@gmail.com','yevhenii','pass123','Мельничук',19);
$user2 = new Users('Віталій','vitalii@gmail.com','vitalii','secure456','Костенко',20);
$user3 = new Users('Денис','denys@gmail.com','denys','myP@ss789','Плотницький',22);

$users = [
    ['obj' => $user1, 'avatar' => 'avatar-indigo', 'initial' => 'Є'],
    ['obj' => $user2, 'avatar' => 'avatar-green', 'initial' => 'В'],
    ['obj' => $user3, 'avatar' => 'avatar-amber', 'initial' => 'Д'],
];

$labels = ['$user1', '$user2', '$user3'];

ob_start();
?>

<div class="task-header">
    <h1>Конструктор Users</h1>
    <p>Об'єкти створюються одразу з початковими значеннями</p>
</div>

<div class="code-block">
<span class="code-comment">// Конструктор класу Users</span>
<span class="code-keyword">public function</span> <span class="code-method">__construct</span>(
    string $name,
    string $email,
    string $nickname,
    string $password,
    string $surname,
    int $age
) {
    $this->name = $name;
    $this->email = $email;
    $this->nickname = $nickname;
    $this->password = $password;
    $this->surname = $surname;
    $this->age = $age;
}

<span class="code-comment">// Створення об'єктів</span>
$user1 = new Users('Євгеній','yevhenii@gmail.com','yevhenii','pass123','Мельничук',19);
$user2 = new Users('Віталій','vitalii@gmail.com','vitalii','secure456','Костенко',20);
$user3 = new Users('Денис','denys@gmail.com','denys','myP@ss789','Плотницький',22);
</div>

<div class="section-divider">
    <span class="section-divider-text">Результат створення через конструктор</span>
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
                    <?= $labels[$i] ?> <span class="user-card-badge badge-constructor">constructor</span>
                </div>
            </div>
        </div>

        <div class="user-card-body">
            <div class="user-card-field">
                <span class="user-card-field-label">nickname</span>
                <span class="user-card-field-value"><?= htmlspecialchars($data['obj']->nickname) ?></span>
            </div>

            <div class="user-card-field">
                <span class="user-card-field-label">age</span>
                <span class="user-card-field-value"><?= $data['obj']->age ?></span>
            </div>

            <div class="user-card-field">
                <span class="user-card-field-label">email</span>
                <span class="user-card-field-value"><?= htmlspecialchars($data['obj']->email) ?></span>
            </div>

            <div class="user-card-field">
                <span class="user-card-field-label">password</span>
                <span class="user-card-field-value"><?= htmlspecialchars($data['obj']->password) ?></span>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>

<div class="section-divider">
    <span class="section-divider-text">getInfo() для об'єктів</span>
</div>

<div class="info-output">
    <div class="info-output-header">
        Виклик getInfo() після створення через конструктор
    </div>
    <div class="info-output-body">
        <?php foreach ($users as $i => $data): ?>
        <div class="info-output-row">
            <span class="info-output-label"><?= $labels[$i] ?></span>
            <span class="info-output-text"><?= htmlspecialchars($data['obj']->getInfo()) ?></span>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
$content = ob_get_clean();
renderDemoLayout($content, 'Завдання 3', 'task3-body');