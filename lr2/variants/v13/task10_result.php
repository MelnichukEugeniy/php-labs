<?php
/**
 * Завдання 10: Результат реєстрації
 */
session_start();
require_once __DIR__ . '/layout.php';

$data = $_SESSION['reg_data'] ?? null;

// Мова
$languages = ['uk'=>'Українська','en'=>'English','de'=>'Deutsch'];
$lang = $_COOKIE['lang'] ?? 'uk';
if(!isset($languages[$lang])) $lang='uk';

// Переклади для результату
$translations = [
    'uk' => [
        'title' => 'Результат реєстрації',
        'lang_selected' => 'Вибрана мова',
        'success_title' => 'Реєстрацію завершено',
        'success_msg' => 'Дані збережено в сесії',
        'login' => 'Логін',
        'gender' => 'Стать',
        'gender_male' => 'Чоловіча',
        'gender_female' => 'Жіноча',
        'city' => 'Місто',
        'hobby' => 'Хобі',
        'about' => 'Про себе',
        'photo' => 'Фотографія',
        'photo_alt' => 'Фото користувача',
        'not_specified' => 'Не вказано',
        'back' => 'Повернутися до форми',
        'error_title' => 'Помилка',
        'error_msg' => 'Дані реєстрації не знайдено. Заповніть форму спочатку.',
        'go_to_form' => 'Перейти до форми',
        'hobbies' => ['sport' => 'Спорт', 'music' => 'Музика', 'reading' => 'Читання', 'gaming' => 'Ігри', 'cooking' => 'Кулінарія', 'travel' => 'Подорожі'],
    ],
    'en' => [
        'title' => 'Registration Result',
        'lang_selected' => 'Selected language',
        'success_title' => 'Registration complete',
        'success_msg' => 'Data saved in session',
        'login' => 'Login',
        'gender' => 'Gender',
        'gender_male' => 'Male',
        'gender_female' => 'Female',
        'city' => 'City',
        'hobby' => 'Hobbies',
        'about' => 'About me',
        'photo' => 'Photo',
        'photo_alt' => 'User photo',
        'not_specified' => 'Not specified',
        'back' => 'Back to form',
        'error_title' => 'Error',
        'error_msg' => 'Registration data not found. Please fill in the form first.',
        'go_to_form' => 'Go to form',
        'hobbies' => ['sport' => 'Sports', 'music' => 'Music', 'reading' => 'Reading', 'gaming' => 'Gaming', 'cooking' => 'Cooking', 'travel' => 'Travel'],
    ],
    'de' => [
        'title' => 'Registrierungsergebnis',
        'lang_selected' => 'Gewählte Sprache',
        'success_title' => 'Registrierung abgeschlossen',
        'success_msg' => 'Daten in der Sitzung gespeichert',
        'login' => 'Benutzername',
        'gender' => 'Geschlecht',
        'gender_male' => 'Männlich',
        'gender_female' => 'Weiblich',
        'city' => 'Stadt',
        'hobby' => 'Hobbys',
        'about' => 'Über mich',
        'photo' => 'Foto',
        'photo_alt' => 'Benutzerfoto',
        'not_specified' => 'Nicht angegeben',
        'back' => 'Zurück zum Formular',
        'error_title' => 'Fehler',
        'error_msg' => 'Registrierungsdaten nicht gefunden. Bitte füllen Sie zuerst das Formular aus.',
        'go_to_form' => 'Zum Formular',
        'hobbies' => ['sport' => 'Sport', 'music' => 'Musik', 'reading' => 'Lesen', 'gaming' => 'Spiele', 'cooking' => 'Kochen', 'travel' => 'Reisen'],
    ],
];

$t = $translations[$lang];
$hobbiesMap = $t['hobbies'];

ob_start();
?>
<div class="demo-card demo-card-wide">
    <h2><?= htmlspecialchars($t['title']) ?></h2>
    <div class="lang-notice"><?= htmlspecialchars($t['lang_selected']) ?>: <?= htmlspecialchars($languages[$lang]) ?></div>

    <?php if ($data): ?>
    <div class="demo-result" style="margin-bottom: 20px;">
        <h3><?= htmlspecialchars($t['success_title']) ?></h3>
        <div class="demo-result-value"><?= htmlspecialchars($t['success_msg']) ?></div>
    </div>

    <div class="result-data">
        <div class="result-data-row"><span class="result-data-label"><?= htmlspecialchars($t['login']) ?></span><span class="result-data-value"><?= htmlspecialchars($data['login'] ?? '') ?></span></div>
        <div class="result-data-row"><span class="result-data-label"><?= htmlspecialchars($t['gender']) ?></span>
            <span class="result-data-value">
                <?php $genderMap=['male'=>$t['gender_male'],'female'=>$t['gender_female']]; echo htmlspecialchars($genderMap[$data['gender'] ?? ''] ?? $t['not_specified']); ?>
            </span>
        </div>
        <div class="result-data-row"><span class="result-data-label"><?= htmlspecialchars($t['city']) ?></span><span class="result-data-value"><?= htmlspecialchars($data['city']??'') ?></span></div>
        <div class="result-data-row"><span class="result-data-label"><?= htmlspecialchars($t['hobby']) ?></span>
            <span class="result-data-value">
                <?php
                $selectedHobbies = $data['hobbies']??[];
                if(!empty($selectedHobbies)){
                    $labels=array_map(fn($k)=>$hobbiesMap[$k]??$k,$selectedHobbies);
                    foreach($labels as $l){ echo '<span class="demo-tag demo-tag-primary" style="margin-right:4px;">'.htmlspecialchars($l).'</span>'; }
                } else { echo htmlspecialchars($t['not_specified']); }
                ?>
            </span>
        </div>
        <div class="result-data-row"><span class="result-data-label"><?= htmlspecialchars($t['about']) ?></span>
            <span class="result-data-value"><?= nl2br(htmlspecialchars($data['about'] ?: $t['not_specified'])) ?></span>
        </div>

        <?php if(!empty($data['photo']) && file_exists(__DIR__.'/'.$data['photo'])): ?>
        <div class="result-data-row">
            <span class="result-data-label"><?= htmlspecialchars($t['photo']) ?></span>
            <span class="result-data-value">
                <img src="<?= htmlspecialchars($data['photo']) ?>" alt="<?= htmlspecialchars($t['photo_alt']) ?>" class="photo-preview">
            </span>
        </div>
        <?php endif; ?>
    </div>

    <div class="flex-buttons" style="margin-top:24px;">
        <a href="task10_form.php" class="btn-secondary"><?= htmlspecialchars($t['back']) ?></a>
    </div>

    <?php else: ?>
    <div class="demo-result demo-result-error">
        <h3><?= htmlspecialchars($t['error_title']) ?></h3>
        <div class="demo-result-value"><?= htmlspecialchars($t['error_msg']) ?></div>
    </div>
    <div class="flex-buttons" style="margin-top:20px;">
        <a href="task10_form.php" class="btn-submit" style="text-decoration:none;color:white;"><?= htmlspecialchars($t['go_to_form']) ?></a>
    </div>
    <?php endif; ?>
</div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Форма: Результат');
