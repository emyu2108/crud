<?php
require 'includes/db.php';
include 'views/header.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Если форма отправлена
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO users (name, email, age) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['name'], $_POST['email'], $_POST['age']]);
    header("Location: index.php");
    exit;
}
?>

<h2>➕ Добавить пользователя</h2>

<form method="post">
    <label>Имя:</label><br>
    <input name="name" required><br><br>

    <label>Email:</label><br>
    <input name="email" required><br><br>

    <label>Возраст:</label><br>
    <input name="age" type="number" required><br><br>

    <button type="submit">💾 Сохранить</button>
</form>

<br>
<a href="index.php">⬅ Назад к списку</a>

<?php include 'views/footer.php'; ?>
