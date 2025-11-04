<?php
include './system/common.php';
include './system/functions.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: image/png');

$basePath = __DIR__ . '/view/image/maneken/';

// Получаем g
$g = isset($_GET['g']) ? (int)$_GET['g'] : 1;
if ($g < 0) $g = 1;

$bodyFile = $basePath . $g . '.png';
if (!is_file($bodyFile)) {
    $bodyFile = $basePath . '1.png';
}

// Создаём фон
$image = imagecreatefrompng($bodyFile);
imagesavealpha($image, true);
imagealphablending($image, true);

// Наложение слоёв
function add_layer($slot, $g, &$image, $basePath) {
    $id = isset($_GET['w_' . $slot]) ? (int)$_GET['w_' . $slot] : 0;
    if ($id <= 0) return;

    $file = $basePath . $g . '/' . $id . '.png';
    if (is_file($file)) {
        $layer = imagecreatefrompng($file);
        imagealphablending($layer, true);
        imagesavealpha($layer, true);
        imagecopy($image, $layer, 0, 0, 0, 0, imagesx($layer), imagesy($layer));
        imagedestroy($layer);
    }
}

// Добавляем все 8 возможных слоёв
for ($i = 1; $i <= 8; $i++) {
    add_layer($i, $g, $image, $basePath);
}

// Убеждаемся, что сохраняется прозрачность
imagesavealpha($image, true);
imagealphablending($image, false);

// Отдаём PNG
imagepng($image);
imagedestroy($image);
?>
