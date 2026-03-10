<?php
/**
 * Завдання 3: Ім'я файлу
 *
 * Виділення директорії, імені файлу без розширення та розширення
 */

require_once __DIR__ . '/layout.php';


function normalizePath(string $path): string {
    return str_replace('\\', '/', $path);
}


function extractDirectory(string $path): string {
    $path = normalizePath($path);
    return dirname($path);
}


function extractFilename(string $path): string {
    $path = normalizePath($path);
    $basename = basename($path);
    return pathinfo($basename, PATHINFO_FILENAME);
}


function extractExtension(string $path): string {
    $path = normalizePath($path);
    $basename = basename($path);
    return pathinfo($basename, PATHINFO_EXTENSION);
}

$path = $_POST['path'] ?? "/home/user/photos/vacation_2024.jpg";
$submitted = isset($_POST['path']);

$directory = extractDirectory($path);
$filename = extractFilename($path);
$extension = extractExtension($path);

ob_start();
?>
<div class="demo-card">
    <h2>Виділення імені файлу</h2>
    <p style="color: var(--color-text-muted); margin-top: 0;">
        Виділення директорії, імені файлу та розширення
    </p>

    <form method="post" class="demo-form">
        <div>
            <label for="path">Повний шлях до файлу</label>
            <input type="text" id="path" name="path" value="<?= htmlspecialchars($path) ?>">
        </div>
        <button type="submit" class="btn-submit">Виділити</button>
    </form>

    <div class="demo-section">
        <h3>Результат</h3>
        <table class="demo-table">
            <tr>
                <td><b>Повний шлях</b></td>
                <td><code><?= htmlspecialchars($path) ?></code></td>
            </tr>
            <tr>
                <td><b>Директорія</b></td>
                <td><code><?= htmlspecialchars($directory) ?></code></td>
            </tr>
            <tr>
                <td><b>Ім'я файлу</b></td>
                <td><span class="demo-tag demo-tag-success"><?= htmlspecialchars($filename) ?></span></td>
            </tr>
            <tr>
                <td><b>Розширення</b></td>
                <td><span class="demo-tag demo-tag-primary"><?= htmlspecialchars($extension) ?></span></td>
            </tr>
        </table>
    </div>

    <div class="demo-code">
extractDirectory("<?= $path ?>") → "<?= $directory ?>"<br>
extractFilename("<?= $path ?>") → "<?= $filename ?>"<br>
extractExtension("<?= $path ?>") → "<?= $extension ?>"
    </div>
</div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, "Рядки: Ім'я файлу");
