<?php
require("auth.php");
include("../php/connect_db.php");

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM categories WHERE id = $id");
    header("Location: categories.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title      = trim($_POST['title']);
    $key_name   = trim($_POST['key_name']);
    $section_id = (int)$_POST['section_id'];
    $sort_order = (int)$_POST['sort_order'];
    $edit_id    = (int)($_POST['edit_id'] ?? 0);

    if ($edit_id) {
        $stmt = $conn->prepare("UPDATE categories SET title=?, key_name=?, section_id=?, sort_order=? WHERE id=?");
        $stmt->bind_param("ssiii", $title, $key_name, $section_id, $sort_order, $edit_id);
    } else {
        $stmt = $conn->prepare("INSERT INTO categories (title, key_name, section_id, sort_order) VALUES (?,?,?,?)");
        $stmt->bind_param("ssii", $title, $key_name, $section_id, $sort_order);
    }
    $stmt->execute();
    header("Location: categories.php");
    exit;
}
$edit = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $edit = $conn->query("SELECT * FROM categories WHERE id = $id")->fetch_assoc();
}

$categories = $conn->query("
    SELECT c.*, s.title AS section_title 
    FROM categories c
    LEFT JOIN sections s ON c.section_id = s.id
    ORDER BY c.section_id, c.sort_order
")->fetch_all(MYSQLI_ASSOC);

$sections = $conn->query("SELECT * FROM sections ORDER BY title")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/admin.css">
    <title>Категории</title>
</head>
<body>
<?php include("parts/sidebar.php"); ?>
<div class="admin-content">
    <?php include("parts/topbar.php"); ?>
    <main class="admin-main">
        <h1 class="page-title">Категории (табы)</h1>
        <div class="admin-form-card">
            <h2><?= $edit ? 'Редактировать категорию' : 'Добавить категорию' ?></h2>
            <form method="POST">
                <?php if ($edit): ?>
                    <input type="hidden" name="edit_id" value="<?= $edit['id'] ?>">
                <?php endif; ?>
                <div class="form-row">
                    <div class="form-group">
                        <label>Название таба</label>
                        <input type="text" name="title" 
                               value="<?= htmlspecialchars($edit['title'] ?? '') ?>" 
                               placeholder="Например: Пользователям" required>
                    </div>
                    <div class="form-group">
                        <label>Key name</label>
                        <input type="text" name="key_name" 
                               value="<?= htmlspecialchars($edit['key_name'] ?? '') ?>" 
                               placeholder="Например: users" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Раздел</label>
                        <select name="section_id">
                            <?php foreach ($sections as $s): ?>
                                <option value="<?= $s['id'] ?>" 
                                    <?= ($edit['section_id'] ?? '') == $s['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($s['title']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Порядок сортировки</label>
                        <input type="number" name="sort_order" 
                               value="<?= $edit['sort_order'] ?? '0' ?>" 
                               placeholder="0">
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                    <?php if ($edit): ?>
                        <a href="categories.php" class="btn btn-secondary">Отмена</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Key name</th>
                        <th>Раздел</th>
                        <th>Сортировка</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $c): ?>
                        <tr>
                            <td><?= $c['id'] ?></td>
                            <td><?= htmlspecialchars($c['title']) ?></td>
                            <td><code><?= htmlspecialchars($c['key_name']) ?></code></td>
                            <td><?= htmlspecialchars($c['section_title'] ?? '—') ?></td>
                            <td><?= $c['sort_order'] ?></td>
                            <td class="table-actions">
                                <a href="categories.php?edit=<?= $c['id'] ?>" class="btn btn-sm btn-secondary">Изменить</a>
                                <a href="categories.php?delete=<?= $c['id'] ?>" class="btn btn-sm btn-danger"
                                   onclick="return confirm('Удалить категорию?')">Удалить</a>
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