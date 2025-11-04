<?php
require_once __DIR__ . '/mysql_compat.php';

// Подключение к MySQL через mysqli
$host = "localhost";     // адрес сервера базы данных
$user = "ole673_gameuser"; // имя пользователя базы данных
$pass = "L4mWSir2N8GkThw";   // пароль пользователя базы данных
$dbname = "ole673_game";   // имя базы данных

$mysqli = new mysqli($host, $user, $pass, $dbname);

if ($mysqli->connect_errno) {
    die("Ошибка подключения к базе данных: " . $mysqli->connect_error);
}

// Устанавливаем кодировку UTF-8
$mysqli->set_charset("utf8");
?>
