<?php
include("php/connect_db.php");

$article = null;

$stmt = $conn->prepare("SELECT id FROM sections WHERE slug = 'taxophone'");
if (!$stmt) die("Ошибка: " . $conn->error);
$stmt->execute();
$section = $stmt->get_result()->fetch_assoc();
$section_id = $section['id'] ?? null;

if (isset($_GET['article'])) {
    $slug = $_GET['article'];
    $stmt = $conn->prepare("SELECT * FROM articles WHERE slug = ?");
    if (!$stmt) die("Ошибка: " . $conn->error);
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $article = $stmt->get_result()->fetch_assoc();
}

$articles = [];
if ($section_id) {
    $stmt = $conn->prepare("SELECT title, slug FROM articles WHERE section_id = ? ORDER BY id");
    if (!$stmt) die("Ошибка: " . $conn->error);
    $stmt->bind_param("i", $section_id);
    $stmt->execute();
    $articles = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/taxophone.css">
    <link rel="icon" href="img/favicon.ico" type="image/ico">
    <title>TaxoPhone - TaxiMaster</title>
</head>
<body>
    <?php include("php/header.php");?>
    <div class="breadcrumb">
        <div class="container">
            <a href="index.php">Главная</a>
            <span class="breadcrumb-sep">›</span>
            <span>Сервис TaxoPhone</span>
        </div>
    </div>
    <div class="page-layout">
        <div class="container page-layout__inner">
<aside class="sidebar">
                <a href="taximaster.php" class="sidebar-item">
                    <span class="sidebar-icon">
                        <img src="img/taximaster.webp" alt="taximaster">
                    </span>
                    <span>Программный комплекс <strong>Такси-Мастер</strong></span>
                </a>
                <a href="taxophone.php" class="sidebar-item">
                    <span class="sidebar-icon">
                        <img src="img/taxophone.png" alt="raxophone">
                    </span>
                    <span>Сервис <strong>TaxoPhone</strong></span>
                </a>
                <a href="tmmarket.php" class="sidebar-item">
                    <span class="sidebar-icon">
                        <img src="img/tmmarket.png" alt="tmmarket">
                    </span>
                    <span>Центр обмена заказами <strong>TMMarket</strong></span>
                </a>
                <a href="tmdriver.php" class="sidebar-item">
                    <span class="sidebar-icon">
                        <img src="img/tmdriver.png" alt="tmdriver">
                    </span>
                    <span>Продвижение для водителей <strong>TMDriver</strong></span>
                </a>
                <a href="robot.php" class="sidebar-item">
                    <span class="sidebar-icon">
                        <img src="img/robot.png" alt="robot">
                    </span>
                    <span>Сервис для обработки звонков <strong>Голосовой робот</strong></span>
                </a>
                <a href="web.php" class="sidebar-item active">
                    <span class="sidebar-icon">
                        <img src="img/web.png" alt="web">
                    </span>
                    <span>Веб-сервисы <strong>Такси Мастер</strong></span>
                </a>
            </aside>
            <main class="content-area">
                <?php if ($article): ?>
                <a href="taxophone.php" class="back-link">← Назад</a>
                <h1 class="content-title"><?= htmlspecialchars($article['title']) ?></h1>

                <?php if ($article['file_type'] == 'html'): ?>
                    <?php include($article['file_path']); ?>
                <?php elseif ($article['file_type'] == 'pdf'): ?>
                    <iframe src="<?= $article['file_path'] ?>" width="100%" height="800px"></iframe>
                <?php endif; ?>

            <?php else: ?>
                <h1 class="content-title">TaxoPhone</h1>

                <ul class="content-list">
                    <?php if (!empty($articles)): ?>
                        <?php foreach ($articles as $item): ?>
                            <li>
                                <a href="taxophone.php?article=<?= $item['slug'] ?>">
                                    <?= htmlspecialchars($item['title']) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>Нет статей</li>
                    <?php endif; ?>
                </ul>
                <div class="info-box">
                    <p>Анкеты для создания или обновления приложения Вы можете заполнить на сайте:
                        <a href="http://taxophone.taximaster.ru/" target="_blank" class="ext-link">
                            http://taxophone.taximaster.ru/
                            <img src="img/external.svg" alt="external" class="ext-icon">
                        </a>
                    </p>
                    <p>Утилита выбора цвета:
                        <a href="http://www.taximaster.ru/taxophone-color-editor/" target="_blank" class="ext-link">
                            http://www.taximaster.ru/taxophone-color-editor/
                            <img src="img/external.svg" alt="external" class="ext-icon">
                        </a>
                    </p>
                </div>
                <div class="taxo-section">
                    <h2 class="taxo-section-title">Видео</h2>
                    <ul class="ext-list">
                        <li>
                            <a href="#" target="_blank" class="ext-link">
                                Совместные поездки
                                <img src="img/external.svg" alt="external" class="ext-icon">
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_blank" class="ext-link">
                                Большое обновление продуктов Такси-Мастер 3.15. Прямой эфир от 30 октября 10:00 мск
                                <img src="img/external.svg" alt="external" class="ext-icon">
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_blank" class="ext-link">
                                TaxoPhone 18 - новая версия
                                <img src="img/external.svg" alt="external" class="ext-icon">
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="taxo-social">
                    <p>
                        Подпишитесь на Такси-Мастер ВКОНТАКТЕ, чтобы больше узнать об увеличении заказов, привлечении водителей и клиентов, конкуренции с сетевиками и агрегаторами
                        <a href="https://vk.com/bm_it" target="_blank" class="ext-link social-link">
                            ПОДПИСАТЬСЯ
                            <img src="img/external.svg" alt="external" class="ext-icon">
                        </a>
                    </p>
                </div>

                <div class="taxo-social">
                    <p class="taxo-social-label">Наш Telegram канал</p>
                    <a href="https://t.me/taximaster" target="_blank" class="ext-link social-link">
                        ПОДПИСАТЬСЯ
                        <img src="img/external.svg" alt="external" class="ext-icon">
                    </a>
                </div>
                <?php endif; ?>
            </main>
        </div>
    </div>
    <?php include("php/footer.php");?>
    <script src = "js/taximaster.js"></script>
    <script src="js/search.js"></script>
</body>
</html>