<?php
include("php/connect_db.php");

$slug = $_GET['s'] ?? null;
$article = null;
$section = null;
$articles = [];

if ($slug) {
    $stmt = $conn->prepare("SELECT * FROM sections WHERE slug = ?");
    if (!$stmt) die("Ошибка: " . $conn->error);
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $section = $stmt->get_result()->fetch_assoc();
}

if ($section) {
    $stmt = $conn->prepare("SELECT title, slug FROM articles WHERE section_id = ? ORDER BY id");
    if (!$stmt) die("Ошибка: " . $conn->error);
    $stmt->bind_param("i", $section['id']);
    $stmt->execute();
    $articles = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

if (isset($_GET['article'])) {
    $aslug = $_GET['article'];
    $stmt = $conn->prepare("SELECT * FROM articles WHERE slug = ?");
    if (!$stmt) die("Ошибка: " . $conn->error);
    $stmt->bind_param("s", $aslug);
    $stmt->execute();
    $article = $stmt->get_result()->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/taximaster.css">
    <link rel="icon" href="img/favicon.ico" type="image/ico">
    <title><?= $section ? htmlspecialchars($section['title']) : 'Раздел' ?></title>
</head>
<body>

    <?php include("php/header.php");?>

<div class="breadcrumb">
    <div class="container">
        <a href="index.php">Главная</a>
        <span class="breadcrumb-sep">›</span>
        <?php if ($article): ?>
            <a href="section.php?s=<?= htmlspecialchars($slug) ?>">
                <?= $section ? htmlspecialchars($section['title']) : 'Раздел' ?>
            </a>
            <span class="breadcrumb-sep">›</span>
            <span><?= htmlspecialchars($article['title']) ?></span>
        <?php else: ?>
            <span><?= $section ? htmlspecialchars($section['title']) : 'Раздел' ?></span>
        <?php endif; ?>
    </div>
</div>
<div class="page-layout">
    <div class="container page-layout__inner">
        <main class="content-area" style="width: 100%;">
            <?php if ($article): ?>
                <a href="section.php?s=<?= htmlspecialchars($slug) ?>" class="back-link">← Назад</a>
                <h1 class="content-title"><?= htmlspecialchars($article['title']) ?></h1>
                <?php if ($article['file_type'] == 'html'): ?>
                    <?php include($article['file_path']); ?>
                <?php elseif ($article['file_type'] == 'pdf'): ?>
                    <iframe src="<?= htmlspecialchars($article['file_path']) ?>" width="100%" height="900px" style="border:none; border-radius:8px;"></iframe>
                <?php endif; ?>
            <?php elseif ($section): ?>
                <h1 class="content-title"><?= htmlspecialchars($section['title']) ?></h1>
                <ul class="content-list">
                    <?php if (!empty($articles)): ?>
                        <?php foreach ($articles as $item): ?>
                            <li>
                                <a href="section.php?s=<?= htmlspecialchars($slug) ?>&article=<?= $item['slug'] ?>">
                                    <?= htmlspecialchars($item['title']) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>Нет статей</li>
                    <?php endif; ?>
                </ul>
            <?php else: ?>
                <h1 class="content-title">Раздел не найден</h1>
                <p>Запрашиваемый раздел не существует. <a href="index.php">Вернуться на главную</a></p>
            <?php endif; ?>
        </main>
    </div>
</div>
<?php include("php/footer.php"); ?>
<script src="js/taximaster.js"></script>
<script src="js/search.js"></script>
</body>
</html>