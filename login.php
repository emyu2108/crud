<?php
require 'includes/db.php';
include 'views/header.php';

// Если уже вошёл
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Ищем пользователя в базе
    $stmt = $pdo->prepare("SELECT * FROM accounts WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $email;
        header("Location: index.php");
        exit;
    } else {
        $error = "❌ Неверный email или пароль";
    }
}
?>

<h2>🔐 Вход</h2>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?= $error ?></p>
<?php endif; ?>

<form method="post">
    <label>Email:</label><br>
    <input name="email" type="email" required><br><br>

    <label>Пароль:</label><br>
    <input name="password" type="password" required><br><br>

    <button type="submit">Войти</button>
</form>

<br>
<a href="register.php">📝 Нет аккаунта? Зарегистрироваться</a>

<?php include 'views/footer.php'; ?>
