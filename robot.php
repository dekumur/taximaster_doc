<?php
include("php/connect_db.php");

$article = null;

$stmt = $conn->prepare("SELECT id FROM sections WHERE slug = 'voice_robot'");
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
    <title>Голосовой робот - TaxiMaster</title>
</head>
<body>
    <?php include("php/header.php");?>
    <div class="breadcrumb">
        <div class="container">
            <a href="index.php">Главная</a>
            <span class="breadcrumb-sep">›</span>
            <span>Голосовой робот</span>
        </div>
    </div>
    <div class="page-layout">
        <div class="container page-layout__inner">
            <aside class="sidebar">
                <a href="taximaster.php" class="sidebar-item">
                    <span class="sidebar-icon">
                        <img src="img/taximaster.png" alt="">
                    </span>
                    <span>Программный комплекс <strong>Такси-Мастер</strong></span>
                </a>
                <a href="taxophone.php" class="sidebar-item">
                    <span class="sidebar-icon">
                        <img src="img/taxophone.png" alt="">
                    </span>
                    <span>Сервис <strong>TaxoPhone</strong></span>
                </a>
                <a href="tmmarket.php" class="sidebar-item">
                    <span class="sidebar-icon">
                        <img src="img/tmmarket.png" alt="">
                    </span>
                    <span>Центр обмена заказами <strong>TMMarket</strong></span>
                </a>
                <a href="tmdriver.php" class="sidebar-item">
                    <span class="sidebar-icon">
                        <img src="img/tmdriver.png" alt="">
                    </span>
                    <span>Продвижение для водителей <strong>TMDriver</strong></span>
                </a>
                <a href="robot.php" class="sidebar-item active">
                    <span class="sidebar-icon">
                        <img src="img/robot.png" alt="">
                    </span>
                    <span>Сервис для обработки звонков <strong>Голосовой робот</strong></span>
                </a>
                <a href="web.php" class="sidebar-item">
                    <span class="sidebar-icon">
                        <img src="img/web.png" alt="">
                    </span>
                    <span>Веб-сервисы <strong>Такси Мастер</strong></span>
                </a>
            </aside>
            <main class="content-area">
            <?php if ($article): ?>
            <a href="tmdriver.php" class="back-link">← Назад</a>
            <h1 class="content-title"><?= htmlspecialchars($article['title']) ?></h1>

            <?php if ($article['file_type'] == 'html'): ?>
                <?php include($article['file_path']); ?>
            <?php elseif ($article['file_type'] == 'pdf'): ?>
                <iframe src="<?= $article['file_path'] ?>" width="100%" height="800px"></iframe>
            <?php endif; ?>
        <?php else: ?>
            <h1 class="content-title">Голосовой робот</h1>
            <p class="content-description">Голосовой робот - это сервис для обработки заказов в службе такси.</p>
            <ul class="content-list">
                <?php if (!empty($articles)): ?>
                    <?php foreach ($articles as $item): ?>
                        <li>
                            <a href="robot.php?article=<?= $item['slug'] ?>">
                                <?= htmlspecialchars($item['title']) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>Нет статей</li>
                <?php endif; ?>
            </ul>
                <div class="faq">
                    <h2 class="faq-title">Часто задаваемые вопросы</h2>

                    <div class="faq-item">
                        <button class="faq-question">
                            Как обратиться в техническую поддержку
                            <span class="faq-arrow">▼</span>
                        </button>
                        <div class="faq-answer">
                            <p>Обратиться в техническую поддержку можно через Единый личный кабинет на сайте Такси-Мастер, либо по телефону горячей линии.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            Как узнать версию Такси-Мастера
                            <span class="faq-arrow">▼</span>
                        </button>
                        <div class="faq-answer">
                            <p>Версию программы можно узнать в меню «Справка» → «О программе» в клиентской части Такси-Мастер.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            Как настроить тариф
                            <span class="faq-arrow">▼</span>
                        </button>
                        <div class="faq-answer">
                            <p>Настройка тарифов производится в разделе «Справочники» → «Тарифы». Укажите зоны, стоимость посадки и стоимость километра.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            Как настроить сдачу с заказа
                            <span class="faq-arrow">▼</span>
                        </button>
                        <div class="faq-answer">
                            <p>Параметры сдачи настраиваются в «Настройки» → «Расчёты». Можно задать фиксированный процент или сумму.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            Как перенести сервер на другой компьютер
                            <span class="faq-arrow">▼</span>
                        </button>
                        <div class="faq-answer">
                            <p>Для переноса сервера необходимо сделать резервную копию базы данных, установить серверную часть на новом компьютере и восстановить данные из бэкапа.</p>
                        </div>
                    </div>
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