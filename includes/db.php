<?php
session_start(); // 🔥 теперь PHP может хранить данные между запросами

$dsn = "mysql:host=localhost;dbname=test;charset=utf8";
$user = "root";
$pass = "";

try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    echo "❌ Ошибка: " . $e->getMessage();
}
