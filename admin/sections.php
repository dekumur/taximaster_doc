<?php
require("auth.php");
include("../php/connect_db.php");

// Удаление
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM sections WHERE id = $id");
    header("Location: sections.php");
    exit;
}

// Сохранение
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title   = trim($_POST['title']);
    $slug    = trim($_POST['slug']);
    $edit_id = (int)($_POST['edit_id'] ?? 0);

    if ($edit_id) {
        $stmt = $conn->prepare("UPDATE sections SET title=?, slug=? WHERE id=?");
        $stmt->bind_param("ssi", $title, $slug, $edit_id);
    } else {
        $stmt = $conn->prepare("INSERT INTO sections (title, slug) VALUES (?,?)");
        $stmt->bind_param("ss", $title, $slug);
    }
    $stmt->execute();
    header("Location: sections.php");
    exit;
}

// Редактирование
$edit = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $edit = $conn->query("SELECT * FROM sections WHERE id = $id")->fetch_assoc();
}

$sections = $conn->query("SELECT * FROM sections ORDER BY id")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/admin.css">
    <title>Разделы</title>
</head>
<body>
<?php include("parts/sidebar.php"); ?>
<div class="admin-content">
    <?php include("parts/topbar.php"); ?>
    <main class="admin-main">
        <h1 class="page-title">Разделы</h1>

        <!-- Форма добавления/редактирования -->
        <div class="admin-form-card">
            <h2><?= $edit ? 'Редактировать раздел' : 'Добавить раздел' ?></h2>
            <form method="POST">
                <?php if ($edit): ?>
                    <input type="hidden" name="edit_id" value="<?= $edit['id'] ?>">
                <?php endif; ?>
                <div class="form-row">
                    <div class="form-group">
                        <label>Название</label>
                        <input type="text" name="title" value="<?= htmlspecialchars($edit['title'] ?? '') ?>" placeholder="Например: Общая информация" required>
                    </div>
                    <div class="form-group">
                        <label>Slug (URL)</label>
                        <input type="text" name="slug" value="<?= htmlspecialchars($edit['slug'] ?? '') ?>" placeholder="Например: docs-general" required>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                    <?php if ($edit): ?>
                        <a href="sections.php" class="btn btn-secondary">Отмена</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <!-- Таблица разделов -->
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Slug</th>
                        <th>Статей</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sections as $s): ?>
                        <?php
                            $count = $conn->query("SELECT COUNT(*) FROM articles WHERE section_id = {$s['id']}")->fetch_row()[0];
                        ?>
                        <tr>
                            <td><?= $s['id'] ?></td>
                            <td><?= htmlspecialchars($s['title']) ?></td>
                            <td><code><?= htmlspecialchars($s['slug']) ?></code></td>
                            <td><?= $count ?></td>
                            <td class="table-actions">
                                <a href="sections.php?edit=<?= $s['id'] ?>" class="btn btn-sm btn-secondary">Изменить</a>
                                <a href="sections.php?delete=<?= $s['id'] ?>" class="btn btn-sm btn-danger"
                                   onclick="return confirm('Удалить раздел? Статьи раздела останутся в БД.')">Удалить</a>
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