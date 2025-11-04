<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "PHP работает<br>";

include '../system/common.php';
echo "common.php найден<br>";

include '../system/functions.php';
echo "functions.php найден<br>";

include '../system/user.php';
echo "user.php найден<br>";
?>
