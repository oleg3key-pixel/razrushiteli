<?php
session_start();
error_reporting(E_ALL);

// Загружаем параметры из .env
$envPath = __DIR__ . '/.env';
if (!file_exists($envPath)) {
    die('Файл .env не найден. Проверьте system/.env');
}

$dotenv = parse_ini_file($envPath);

// Подключение к базе через mysqli
$mysqli = new mysqli(
    $dotenv['DB_HOST'],
    $dotenv['DB_USER'],
    $dotenv['DB_PASS'],
    $dotenv['DB_NAME']
);

if ($mysqli->connect_errno) {
    die('Ошибка подключения к БД: ' . $mysqli->connect_error);
}

// Устанавливаем кодировку
$mysqli->set_charset('utf8mb4');

// Можно использовать глобально
$GLOBALS['mysqli'] = $mysqli;
?>