<?php
require 'includes/db.php';
include 'views/header.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

    <h2>👤 Пользователи</h2>
    <a href="logout.php"><button>🚪 Выйти</button></a>
    <a href="create.php"><button>➕ Добавить нового пользователя</button></a><br><br>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Email</th>
            <th>Возраст</th>
            <th>Действия</th>
        </tr>

        <?php foreach ($users as $u): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['name']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td><?= $u['age'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $u['id'] ?>">✏️</a> |
                    <a href="delete.php?id=<?= $u['id'] ?>" onclick="return confirm('Удалить пользователя?')">🗑️</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

<?php include 'views/footer.php'; ?>