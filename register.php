<?php
require 'includes/db.php';
include 'views/header.php';

// Если пользователь уже вошёл
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    // Проверка совпадения паролей
    if ($password !== $confirm) {
        $error = "❌ Пароли не совпадают";
    } else {
        // Проверяем, есть ли пользователь с таким email
        $stmt = $pdo->prepare("SELECT * FROM accounts WHERE email = ?");
        $stmt->execute([$email]);
        $existingUser = $stmt->fetch();

        if ($existingUser) {
            $error = "⚠️ Пользователь с таким email уже существует";
        } else {
            // Хэшируем пароль и сохраняем
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO accounts (email, password) VALUES (?, ?)");
            $stmt->execute([$email, $hashed]);

            $_SESSION['user'] = $email; // сразу авторизуем после регистрации
            header("Location: index.php");
            exit;
        }
    }
}
?>

<h2>📝 Регистрация</h2>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?= $error ?></p>
<?php endif; ?>

<form method="post">
    <label>Email:</label><br>
    <input name="email" type="email" required><br><br>

    <label>Пароль:</label><br>
    <input name="password" type="password" required><br><br>

    <label>Подтвердите пароль:</label><br>
    <input name="confirm" type="password" required><br><br>

    <button type="submit">Создать аккаунт</button>
</form>

<br>
<a href="login.php">🔑 Уже есть аккаунт? Войти</a>

<?php include 'views/footer.php'; ?>
