<?php
require 'includes/db.php';

// Удаляем пользователя из сессии
unset($_SESSION['user']);

// Перенаправляем на страницу входа
header("Location: login.php");
exit;
