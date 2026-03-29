<?php
session_start();
include("../php/connect_db.php");

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM admins WHERE login = ? AND password = ?");
    $stmt->bind_param("ss", $login, $password);
    $stmt->execute();
    $admin = $stmt->get_result()->fetch_assoc();

    if ($admin) {
        $_SESSION['admin_id'] = $admin['id'];
        header("Location: index.php");
        exit;
    } else {
        $error = 'Неверный логин или пароль';
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <title>Вход в админпанель</title>
</head>
<body class="login-page">
    <div class="login-box">
        <h1>Админпанель</h1>
        <?php if ($error): ?>
            <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label>Логин</label>
                <input type="text" name="login" required autofocus>
            </div>
            <div class="form-group">
                <label>Пароль</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-full">Войти</button>
        </form>
    </div>
</body>
</html>