<?php
require("auth.php");
include("../php/connect_db.php");

$articles_count = $conn->query("SELECT COUNT(*) FROM articles")->fetch_row()[0];
$sections_count = $conn->query("SELECT COUNT(*) FROM sections")->fetch_row()[0];
$updates_count  = $conn->query("SELECT COUNT(*) FROM updates")->fetch_row()[0];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <title>Админпанель</title>
</head>
<body>
<?php include("parts/sidebar.php"); ?>
<div class="admin-content">
    <?php include("parts/topbar.php"); ?>
    <main class="admin-main">
        <h1 class="page-title">Дашборд</h1>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">📄</div>
                <div class="stat-info">
                    <span class="stat-num"><?= $articles_count ?></span>
                    <span class="stat-label">Статей</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📁</div>
                <div class="stat-info">
                    <span class="stat-num"><?= $sections_count ?></span>
                    <span class="stat-label">Разделов</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🔄</div>
                <div class="stat-info">
                    <span class="stat-num"><?= $updates_count ?></span>
                    <span class="stat-label">Обновлений</span>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>