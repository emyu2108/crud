<?php
require 'includes/db.php';
include 'views/header.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Получаем ID из адреса
$id = $_GET['id'] ?? null;
if (!$id) {
    die("❌ Не указан ID пользователя");
}

// Загружаем данные пользователя
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("❌ Пользователь не найден");
}

// Если форма отправлена — обновляем
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE users SET name=?, email=?, age=? WHERE id=?");
    $stmt->execute([$_POST['name'], $_POST['email'], $_POST['age'], $id]);
    header("Location: index.php");
    exit;
}
?>

<h2>✏️ Редактировать пользователя</h2>

<form method="post">
    <label>Имя:</label><br>
    <input name="name" value="<?= htmlspecialchars($user['name']) ?>" required><br><br>

    <label>Email:</label><br>
    <input name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br><br>

    <label>Возраст:</label><br>
    <input name="age" type="number" value="<?= $user['age'] ?>" required><br><br>

    <button type="submit">💾 Сохранить изменения</button>
</form>

<br>
<a href="index.php">⬅ Назад к списку</a>

<?php include 'views/footer.php'; ?>
