<?php
require 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Получаем id из URL
$id = $_GET['id'] ?? null;

// Проверяем, что id передан
if (!$id) {
    die("❌ Не указан ID пользователя");
}

// Готовим и выполняем запрос
$stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
$stmt->execute([$id]);

// Возвращаемся на главную
header("Location: index.php");
exit;
