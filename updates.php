<?php
include("php/connect_db.php");

$stmt = $conn->prepare("SELECT * FROM updates ORDER BY sort_order DESC");
if (!$stmt) die("Ошибка: " . $conn->error);
$stmt->execute();
$allUpdates = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$currentUpdate = null;
if (isset($_GET['version'])) {
    foreach ($allUpdates as $u) {
        if ($u['version'] === $_GET['version']) {
            $currentUpdate = $u;
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="История обновлений программного комплекса Такси-Мастер — список изменений по версиям.">
    <meta name="keywords" content="обновления Такси-Мастер, версии, changelog, новые функции">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="Документация TaxiMaster">
    <meta property="og:description" content="Полная документация по программному комплексу Такси-Мастер и смежным сервисам.">
    <meta property="og:type" content="website">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/taxophone.css">
    <link rel="stylesheet" href="css/updates.css">
    <link rel="icon" href="img/favicon.ico" type="image/ico">
    <title>Обновления системы</title>
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

    <?php include("php/header.php");?>

<div class="breadcrumb">
    <div class="container">
        <a href="index.php">Главная</a>
        <span class="breadcrumb-sep">›</span>
        <?php if ($currentUpdate): ?>
            <a href="updates.php">Обновления системы</a>
            <span class="breadcrumb-sep">›</span>
            <span>Версия <?= htmlspecialchars($currentUpdate['version']) ?></span>
        <?php else: ?>
            <span>Обновления системы</span>
        <?php endif; ?>
    </div>
</div>

<div class="page-layout">
    <div class="container page-layout__inner">

        <aside class="sidebar">
            <p class="sidebar-versions-title">Версии</p>
            <?php foreach ($allUpdates as $u): ?>
                <a href="updates.php?version=<?= urlencode($u['version']) ?>"
                   class="sidebar-item <?= ($currentUpdate && $currentUpdate['id'] === $u['id']) ? 'active' : '' ?>">
                    <span>Версия <?= htmlspecialchars($u['version']) ?></span>
                    <?php if ($u['release_date']): ?>
                        <span class="sidebar-version-date"><?= date('d.m.Y', strtotime($u['release_date'])) ?></span>
                    <?php endif; ?>
                </a>
            <?php endforeach; ?>
        </aside>

        <main class="content-area">

        <?php if ($currentUpdate): ?>
            <a href="updates.php" class="back-link">← Назад</a>
            <h1 class="content-title">Версия <?= htmlspecialchars($currentUpdate['version']) ?></h1>

            <div class="update-content">
                <?php if ($currentUpdate['file_path'] && file_exists($currentUpdate['file_path'])): ?>
                    <iframe 
                        src="<?= htmlspecialchars($currentUpdate['file_path']) ?>" 
                        width="100%" 
                        height="900px" 
                        style="border: none; border-radius: 8px;">
                    </iframe>
                <?php else: ?>
                    <p>Файл обновления не найден.</p>
                <?php endif; ?>
            </div>

            <?php else: ?>
                <h1 class="content-title">Обновления системы</h1>

                <ul class="content-list">
                    <?php foreach ($allUpdates as $u): ?>
                        <li>
                            <a href="updates.php?version=<?= urlencode($u['version']) ?>">
                                Версия <?= htmlspecialchars($u['version']) ?>
                                <?php if ($u['release_date']): ?>
                                    <span class="list-date"><?= date('d.m.Y', strtotime($u['release_date'])) ?></span>
                                <?php endif; ?>
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
<script src="js/updates.js"></script>
<script src="js/search.js"></script>
</body>
</html>