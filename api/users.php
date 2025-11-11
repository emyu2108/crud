<?php
require '../includes/db.php';

// Устанавливаем заголовки
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *'); // чтобы API работало из любого источника

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // вернуть список пользователей
        $stmt = $pdo->query("SELECT * FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($users);
        break;

    case 'POST':
        // создать нового пользователя
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("INSERT INTO users (name, email, age) VALUES (?, ?, ?)");
        $stmt->execute([$data['name'], $data['email'], $data['age']]);
        echo json_encode(['status' => 'ok мок', 'message' => 'User created']);
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
}
