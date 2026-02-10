<?php
/**
 * Завдання 1: Форматований текст
 *
 * Вірш про художника з форматуванням: <b>, <i>, margin-left
 */
require_once __DIR__ . '/layout.php';

ob_start();
?>
<div class="poem">
    <?php
    echo "<p style='margin-left: 20px;'> Карпатські <b>полонини</b> в тумані,</p>";
    echo "<p style='margin-left: 20px;'> Потічок дзюрчить <i>тихенько</i> в яру,</p>";
    echo "<p style='margin-left: 20px;'> Вівці пасуться на галявині,</p>";
    echo "<p style='margin-left: 20px;'>Пастух грає на трембіті вранці.</p>";
    ?>
</div>
<?php
$content = ob_get_clean();

renderVariantLayout($content, 'Завдання 1', 'task2-body');
