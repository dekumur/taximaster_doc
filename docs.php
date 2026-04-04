<?php
include("php/connect_db.php");

$stmt = $conn->prepare("SELECT id FROM sections WHERE slug = 'docs'");
if (!$stmt) die("Ошибка: " . $conn->error);
$stmt->execute();
$section = $stmt->get_result()->fetch_assoc();
$section_id = $section['id'] ?? null;

$allDocs = [];
if ($section_id) {
    $stmt = $conn->prepare("SELECT * FROM articles WHERE section_id = ? ORDER BY id");
    if (!$stmt) die("Ошибка: " . $conn->error);
    $stmt->bind_param("i", $section_id);
    $stmt->execute();
    $allDocs = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
$currentDoc = null;
if (isset($_GET['article'])) {
    $aslug = $_GET['article'];
    $stmt = $conn->prepare("SELECT * FROM articles WHERE slug = ?");
    if (!$stmt) die("Ошибка: " . $conn->error);
    $stmt->bind_param("s", $aslug);
    $stmt->execute();
    $currentDoc = $stmt->get_result()->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/taximaster.css">
    <link rel="stylesheet" href="css/updates.css">
    <link rel="icon" href="img/favicon.ico" type="image/ico">
    <title>Документация</title>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function(m,e,t,r,i,k,a){
        m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)
    })(window, document,'script','https://mc.yandex.ru/metrika/tag.js?id=108390133', 'ym');

    ym(108390133, 'init', {ssr:true, webvisor:true, clickmap:true, ecommerce:"dataLayer", referrer: document.referrer, url: location.href, accurateTrackBounce:true, trackLinks:true});
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/108390133" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</head>
<body>

<?php include("php/header.php"); ?>

<div class="breadcrumb">
    <div class="container">
        <a href="index.php">Главная</a>
        <span class="breadcrumb-sep">›</span>
        <?php if ($currentDoc): ?>
            <a href="docs.php">Документация</a>
            <span class="breadcrumb-sep">›</span>
            <span><?= htmlspecialchars($currentDoc['title']) ?></span>
        <?php else: ?>
            <span>Документация</span>
        <?php endif; ?>
    </div>
</div>
<div class="page-layout">
    <div class="container page-layout__inner">
        <aside class="sidebar">
            <p class="sidebar-versions-title">Документы</p>
            <?php foreach ($allDocs as $doc): ?>
                <a href="docs.php?article=<?= $doc['slug'] ?>"
                   class="sidebar-item <?= ($currentDoc && $currentDoc['id'] === $doc['id']) ? 'active' : '' ?>">
                    <span><?= htmlspecialchars($doc['title']) ?></span>
                </a>
            <?php endforeach; ?>
            <?php if (empty($allDocs)): ?>
                <p style="padding: 12px 16px; color: #aaa; font-size: 13px;">Нет документов</p>
            <?php endif; ?>
        </aside>
        <main class="content-area">
            <?php if ($currentDoc): ?>
                <a href="docs.php" class="back-link">← Назад</a>
                <h1 class="content-title"><?= htmlspecialchars($currentDoc['title']) ?></h1>
                <?php if ($currentDoc['file_type'] == 'html'): ?>
                    <?php if (file_exists($currentDoc['file_path'])): ?>
                        <?php include($currentDoc['file_path']); ?>
                    <?php else: ?>
                        <p style="color:#888">Файл не найден: <?= htmlspecialchars($currentDoc['file_path']) ?></p>
                    <?php endif; ?>
                <?php elseif ($currentDoc['file_type'] == 'pdf'): ?>
                    <iframe
                        src="<?= htmlspecialchars($currentDoc['file_path']) ?>"
                        width="100%"
                        height="900px"
                        style="border: none; border-radius: 8px;">
                    </iframe>
                <?php endif; ?>
            <?php else: ?>
                <h1 class="content-title">Документация</h1>
                <p class="content-description">Выберите документ из списка слева.</p>
                <ul class="content-list">
                    <?php foreach ($allDocs as $doc): ?>
                        <li>
                            <a href="docs.php?article=<?= $doc['slug'] ?>">
                                <?= htmlspecialchars($doc['title']) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </main>
    </div>
</div>

<?php include("php/footer.php"); ?>
<script src="js/taximaster.js"></script>
<script src="js/search.js"></script>
</body>
</html>