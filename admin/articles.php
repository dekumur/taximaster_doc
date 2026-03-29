<?php
require("auth.php");
include("../php/connect_db.php");

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM articles WHERE id = $id");
    header("Location: articles.php");
    exit;
}

$articles = $conn->query("
    SELECT a.*, s.title AS section_title 
    FROM articles a 
    LEFT JOIN sections s ON a.section_id = s.id 
    ORDER BY a.id DESC
")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/admin.css">
    <title>Статьи</title>
</head>
<body>
<?php include("parts/sidebar.php"); ?>
<div class="admin-content">
    <?php include("parts/topbar.php"); ?>
    <main class="admin-main">
        <div class="page-header">
            <h1 class="page-title">Статьи</h1>
            <a href="article_edit.php" class="btn btn-primary">+ Добавить статью</a>
        </div>

        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Slug</th>
                        <th>Раздел</th>
                        <th>Тип файла</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($articles as $a): ?>
                    <tr>
                        <td><?= $a['id'] ?></td>
                        <td><?= htmlspecialchars($a['title']) ?></td>
                        <td><code><?= htmlspecialchars($a['slug']) ?></code></td>
                        <td><?= htmlspecialchars($a['section_title'] ?? '—') ?></td>
                        <td><?= strtoupper($a['file_type'] ?? '—') ?></td>
                        <td class="table-actions">
                            <a href="article_editor.php?id=<?= $a['id'] ?>" class="btn btn-sm btn-primary">✏️ Редактор</a>
                            <a href="article_edit.php?id=<?= $a['id'] ?>" class="btn btn-sm btn-secondary">Изменить</a>
                            <a href="articles.php?delete=<?= $a['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Удалить статью?')">Удалить</a>
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