<?php
require("auth.php");
include("../php/connect_db.php");

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM updates WHERE id = $id");
    header("Location: updates.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $version    = trim($_POST['version']);
    $release_date = $_POST['release_date'] ?: null;
    $file_path  = trim($_POST['file_path']);
    $sort_order = (int)$_POST['sort_order'];
    $edit_id    = (int)($_POST['edit_id'] ?? 0);

    if ($edit_id) {
        $stmt = $conn->prepare("UPDATE updates SET version=?, release_date=?, file_path=?, sort_order=? WHERE id=?");
        $stmt->bind_param("sssii", $version, $release_date, $file_path, $sort_order, $edit_id);
    } else {
        $stmt = $conn->prepare("INSERT INTO updates (version, release_date, file_path, sort_order) VALUES (?,?,?,?)");
        $stmt->bind_param("sssi", $version, $release_date, $file_path, $sort_order);
    }
    $stmt->execute();
    header("Location: updates.php");
    exit;
}

$edit = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $edit = $conn->query("SELECT * FROM updates WHERE id = $id")->fetch_assoc();
}

$updates = $conn->query("SELECT * FROM updates ORDER BY sort_order DESC")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/admin.css">
    <title>Обновления</title>
</head>
<body>
<?php include("parts/sidebar.php"); ?>
<div class="admin-content">
    <?php include("parts/topbar.php"); ?>
    <main class="admin-main">
        <h1 class="page-title">Обновления системы</h1>

        <div class="admin-form-card">
            <h2><?= $edit ? 'Редактировать' : 'Добавить обновление' ?></h2>
            <form method="POST">
                <?php if ($edit): ?>
                    <input type="hidden" name="edit_id" value="<?= $edit['id'] ?>">
                <?php endif; ?>
                <div class="form-row">
                    <div class="form-group">
                        <label>Версия</label>
                        <input type="text" name="version" value="<?= htmlspecialchars($edit['version'] ?? '') ?>" placeholder="3.16" required>
                    </div>
                    <div class="form-group">
                        <label>Дата выхода</label>
                        <input type="date" name="release_date" value="<?= $edit['release_date'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label>Порядок сортировки</label>
                        <input type="number" name="sort_order" value="<?= $edit['sort_order'] ?? '0' ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label>Путь к PDF файлу</label>
                    <input type="text" name="file_path" value="<?= htmlspecialchars($edit['file_path'] ?? '') ?>" placeholder="articles/updates/v3.16.pdf">
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                    <?php if ($edit): ?>
                        <a href="updates.php" class="btn btn-secondary">Отмена</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Версия</th>
                        <th>Дата</th>
                        <th>Файл</th>
                        <th>Сортировка</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($updates as $u): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($u['version']) ?></strong></td>
                        <td><?= $u['release_date'] ? date('d.m.Y', strtotime($u['release_date'])) : '—' ?></td>
                        <td><code><?= htmlspecialchars($u['file_path'] ?? '—') ?></code></td>
                        <td><?= $u['sort_order'] ?></td>
                        <td class="table-actions">
                            <a href="updates.php?edit=<?= $u['id'] ?>" class="btn btn-sm btn-secondary">Изменить</a>
                            <a href="updates.php?delete=<?= $u['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Удалить?')">Удалить</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
</html>