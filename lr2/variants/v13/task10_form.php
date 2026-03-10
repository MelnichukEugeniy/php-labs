<?php
/**
 * Завдання 10: Реєстраційна форма
 *
 * Демонстрація: форма з POST, збереження в сесію, автозаповнення,
 * вибір мови через GET + cookie, завантаження фото
 */
session_start();
require_once __DIR__ . '/layout.php';

// --- Мова ---
$languages = [
    'uk' => 'Українська',
    'en' => 'English',
    'de' => 'Deutsch',
];

// GET -> cookie -> default
if (isset($_GET['lang']) && isset($languages[$_GET['lang']])) {
    $lang = $_GET['lang'];
    setcookie('lang', $lang, time() + 6 * 30 * 24 * 3600, '/'); // 6 місяців
} elseif (isset($_COOKIE['lang']) && isset($languages[$_COOKIE['lang']])) {
    $lang = $_COOKIE['lang'];
} else {
    $lang = 'uk';
}

// --- Переклади ---
$translations = [
    'uk' => [
        'title' => 'Реєстраційна форма',
        'lang_label' => 'Мова:',
        'lang_selected' => 'Вибрана мова',
        'login' => 'Логін',
        'login_placeholder' => 'Ваш логін',
        'password' => 'Пароль',
        'password_placeholder' => 'Мін. 4 символи',
        'password2' => 'Повторіть пароль',
        'password2_placeholder' => 'Ще раз',
        'gender' => 'Стать',
        'gender_male' => 'Чоловіча',
        'gender_female' => 'Жіноча',
        'city' => 'Місто',
        'city_placeholder' => '-- Оберіть місто --',
        'hobby' => 'Хобі',
        'about' => 'Про себе',
        'about_placeholder' => 'Розкажіть про себе...',
        'photo' => 'Фотографія',
        'photo_saved' => 'Поточне фото збережено в сесії',
        'submit' => 'Зареєструватися',
        'errors_title' => 'Помилки',
        'err_login_empty' => 'Логін не може бути порожнім',
        'err_password_short' => 'Пароль повинен бути не менше 4 символів',
        'err_password_mismatch' => 'Паролі не збігаються',
        'err_gender' => 'Оберіть стать',
        'err_city' => 'Оберіть місто',
        'err_photo_format' => 'Дозволені формати фото: JPG, PNG, GIF, WEBP',
        'cities' => ['Київ', 'Харків', 'Одеса', 'Дніпро', 'Запоріжжя', 'Львів', 'Вінниця', 'Полтава', 'Житомир', 'Черкаси'],
        'hobbies' => ['sport' => 'Спорт', 'music' => 'Музика', 'reading' => 'Читання', 'gaming' => 'Ігри', 'cooking' => 'Кулінарія', 'travel' => 'Подорожі'],
    ],
    'en' => [
        'title' => 'Registration Form',
        'lang_label' => 'Language:',
        'lang_selected' => 'Selected language',
        'login' => 'Login',
        'login_placeholder' => 'Your login',
        'password' => 'Password',
        'password_placeholder' => 'Min. 4 characters',
        'password2' => 'Repeat password',
        'password2_placeholder' => 'Once more',
        'gender' => 'Gender',
        'gender_male' => 'Male',
        'gender_female' => 'Female',
        'city' => 'City',
        'city_placeholder' => '-- Select city --',
        'hobby' => 'Hobbies',
        'about' => 'About me',
        'about_placeholder' => 'Tell about yourself...',
        'photo' => 'Photo',
        'photo_saved' => 'Current photo saved in session',
        'submit' => 'Register',
        'errors_title' => 'Errors',
        'err_login_empty' => 'Login cannot be empty',
        'err_password_short' => 'Password must be at least 4 characters',
        'err_password_mismatch' => 'Passwords do not match',
        'err_gender' => 'Select gender',
        'err_city' => 'Select city',
        'err_photo_format' => 'Allowed photo formats: JPG, PNG, GIF, WEBP',
        'cities' => ['Kyiv', 'Kharkiv', 'Odesa', 'Dnipro', 'Zaporizhzhia', 'Lviv', 'Vinnytsia', 'Poltava', 'Zhytomyr', 'Cherkasy'],
        'hobbies' => ['sport' => 'Sports', 'music' => 'Music', 'reading' => 'Reading', 'gaming' => 'Gaming', 'cooking' => 'Cooking', 'travel' => 'Travel'],
    ],
    'de' => [
        'title' => 'Registrierungsformular',
        'lang_label' => 'Sprache:',
        'lang_selected' => 'Gewählte Sprache',
        'login' => 'Benutzername',
        'login_placeholder' => 'Ihr Benutzername',
        'password' => 'Passwort',
        'password_placeholder' => 'Min. 4 Zeichen',
        'password2' => 'Passwort wiederholen',
        'password2_placeholder' => 'Nochmal',
        'gender' => 'Geschlecht',
        'gender_male' => 'Männlich',
        'gender_female' => 'Weiblich',
        'city' => 'Stadt',
        'city_placeholder' => '-- Stadt wählen --',
        'hobby' => 'Hobbys',
        'about' => 'Über mich',
        'about_placeholder' => 'Erzählen Sie über sich...',
        'photo' => 'Foto',
        'photo_saved' => 'Aktuelles Foto in der Sitzung gespeichert',
        'submit' => 'Registrieren',
        'errors_title' => 'Fehler',
        'err_login_empty' => 'Benutzername darf nicht leer sein',
        'err_password_short' => 'Passwort muss mindestens 4 Zeichen lang sein',
        'err_password_mismatch' => 'Passwörter stimmen nicht überein',
        'err_gender' => 'Geschlecht wählen',
        'err_city' => 'Stadt wählen',
        'err_photo_format' => 'Erlaubte Fotoformate: JPG, PNG, GIF, WEBP',
        'cities' => ['Kyjiw', 'Charkiw', 'Odessa', 'Dnipro', 'Saporischschja', 'Lwiw', 'Winnyzja', 'Poltawa', 'Schytomyr', 'Tscherkasy'],
        'hobbies' => ['sport' => 'Sport', 'music' => 'Musik', 'reading' => 'Lesen', 'gaming' => 'Spiele', 'cooking' => 'Kochen', 'travel' => 'Reisen'],
    ],
];

$t = $translations[$lang];
$cities = $t['cities'];
$hobbies = $t['hobbies'];

// --- Автозаповнення з сесії ---
$sessionData = $_SESSION['reg_data'] ?? [];

// --- Обробка форми ---
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $city = $_POST['city'] ?? '';
    $selectedHobbies = $_POST['hobbies'] ?? [];
    $about = trim($_POST['about'] ?? '');

    // Валідація
    if ($login === '') {
        $errors[] = $t['err_login_empty'];
    }
    if (strlen($password) < 4) {
        $errors[] = $t['err_password_short'];
    }
    if ($password !== $password2) {
        $errors[] = $t['err_password_mismatch'];
    }
    if (!in_array($gender, ['male', 'female'])) {
        $errors[] = $t['err_gender'];
    }
    if ($city === '') {
        $errors[] = $t['err_city'];
    }

    // Обробка фото
    $photoPath = '';
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (in_array($_FILES['photo']['type'], $allowedTypes)) {
            $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
            $newName = uniqid('photo_') . '.' . $ext;
            $uploadDir = __DIR__ . '/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $destination = $uploadDir . $newName;
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $destination)) {
                $photoPath = 'uploads/' . $newName;
            }
        } else {
            $errors[] = $t['err_photo_format'];
        }
    }

    // Зберігаємо в сесію
    $regData = [
        'login' => $login,
        'gender' => $gender,
        'city' => $city,
        'hobbies' => $selectedHobbies,
        'about' => $about,
        'photo' => $photoPath ?: ($sessionData['photo'] ?? ''),
    ];
    $_SESSION['reg_data'] = $regData;

    if (empty($errors)) {
        // Перенаправляємо на сторінку результатів
        header('Location: task10_result.php');
        exit;
    }
}

// Для автозаповнення
$formData = [
    'login' => $_POST['login'] ?? $sessionData['login'] ?? '',
    'gender' => $_POST['gender'] ?? $sessionData['gender'] ?? '',
    'city' => $_POST['city'] ?? $sessionData['city'] ?? '',
    'hobbies' => $_POST['hobbies'] ?? $sessionData['hobbies'] ?? [],
    'about' => $_POST['about'] ?? $sessionData['about'] ?? '',
];

ob_start();
?>
<div class="demo-card demo-card-wide">
    <h2><?= htmlspecialchars($t['title']) ?></h2>

    <!-- Вибір мови -->
    <div class="lang-selector">
        <span style="font-size: 14px; color: var(--color-text-muted); margin-right: 8px;"><?= htmlspecialchars($t['lang_label']) ?></span>
        <?php foreach ($languages as $code => $name): ?>
        <a href="?lang=<?= $code ?>" class="<?= $lang === $code ? 'active' : '' ?>">
            <?= htmlspecialchars($name) ?>
        </a>
        <?php endforeach; ?>
    </div>
    <div class="lang-notice"><?= htmlspecialchars($t['lang_selected']) ?>: <?= htmlspecialchars($languages[$lang]) ?></div>

    <?php if (!empty($errors)): ?>
    <div class="demo-result demo-result-error" style="margin-bottom: 20px;">
        <h3><?= htmlspecialchars($t['errors_title']) ?></h3>
        <ul style="margin: 0; padding-left: 20px; text-align: left;">
            <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data" class="demo-form" style="text-align: left;">
        <div class="form-group">
            <label for="login"><?= htmlspecialchars($t['login']) ?></label>
            <input type="text" id="login" name="login" value="<?= htmlspecialchars($formData['login']) ?>" placeholder="<?= htmlspecialchars($t['login_placeholder']) ?>" required>
        </div>

        <div class="form-group">
            <div class="form-row">
                <div>
                    <label for="password"><?= htmlspecialchars($t['password']) ?></label>
                    <input type="password" id="password" name="password" placeholder="<?= htmlspecialchars($t['password_placeholder']) ?>" required>
                </div>
                <div>
                    <label for="password2"><?= htmlspecialchars($t['password2']) ?></label>
                    <input type="password" id="password2" name="password2" placeholder="<?= htmlspecialchars($t['password2_placeholder']) ?>" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label><?= htmlspecialchars($t['gender']) ?></label>
            <div class="radio-group">
                <label>
                    <input type="radio" name="gender" value="male" <?= $formData['gender'] === 'male' ? 'checked' : '' ?>>
                    <?= htmlspecialchars($t['gender_male']) ?>
                </label>
                <label>
                    <input type="radio" name="gender" value="female" <?= $formData['gender'] === 'female' ? 'checked' : '' ?>>
                    <?= htmlspecialchars($t['gender_female']) ?>
                </label>
            </div>
        </div>

        <div class="form-group">
            <label for="city"><?= htmlspecialchars($t['city']) ?></label>
            <select id="city" name="city" required>
                <option value=""><?= htmlspecialchars($t['city_placeholder']) ?></option>
                <?php foreach ($cities as $c): ?>
                <option value="<?= htmlspecialchars($c) ?>" <?= $formData['city'] === $c ? 'selected' : '' ?>>
                    <?= htmlspecialchars($c) ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label><?= htmlspecialchars($t['hobby']) ?></label>
            <div class="checkbox-group">
                <?php foreach ($hobbies as $key => $label): ?>
                <label>
                    <input type="checkbox" name="hobbies[]" value="<?= $key ?>" <?= in_array($key, $formData['hobbies']) ? 'checked' : '' ?>>
                    <?= htmlspecialchars($label) ?>
                </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="about"><?= htmlspecialchars($t['about']) ?></label>
            <textarea id="about" name="about" rows="3" placeholder="<?= htmlspecialchars($t['about_placeholder']) ?>"><?= htmlspecialchars($formData['about']) ?></textarea>
        </div>

        <div class="form-group">
            <label for="photo"><?= htmlspecialchars($t['photo']) ?></label>
            <input type="file" id="photo" name="photo" accept="image/*">
            <?php if (!empty($sessionData['photo']) && file_exists(__DIR__ . '/' . $sessionData['photo'])): ?>
            <p style="font-size: 13px; color: var(--color-text-muted); margin-top: 4px;">
                <?= htmlspecialchars($t['photo_saved']) ?>
            </p>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn-submit" style="align-self: flex-start;"><?= htmlspecialchars($t['submit']) ?></button>
    </form>
</div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Форма: Реєстрація');
