<?php
include("php/connect_db.php");

$article = null;

if (isset($_GET['article'])) {
    $slug = $_GET['article'];
    $stmt = $conn->prepare("SELECT * FROM articles WHERE slug = ?");
    if (!$stmt) die("Ошибка: " . $conn->error);
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $article = $stmt->get_result()->fetch_assoc();
}

$stmt = $conn->prepare("SELECT key_name, title FROM categories WHERE section_id = 1 ORDER BY sort_order");
if (!$stmt) die("Ошибка: " . $conn->error);
$stmt->execute();
$tabs = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$stmt = $conn->prepare("SELECT title, slug, category FROM articles WHERE section_id = 1 ORDER BY id");
if (!$stmt) die("Ошибка: " . $conn->error);
$stmt->execute();
$result = $stmt->get_result();

$articlesByCategory = [];
while ($row = $result->fetch_assoc()) {
    $cat = $row['category'] ?? 'other';
    $articlesByCategory[$cat][] = $row;
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
    <title>Такси-Мастер</title>
</head>
<body>
    <header>
        <div class="container">
            <div class="header_wrap">
                <div class="logo">
                    <a href="index.php"><img src="img/logo.svg" alt="logo"></a>
                </div>
                <div class="search-box">
                    <div class="input-wrap">
                        <img src="img/search.svg" alt="search">
                        <input type="text" placeholder="Найти информацию...">
                    </div>
                </div>
                <nav class="nav">
                    <div class="dropdown">
                        <a href="#">Документация <span><img src="img/arrow_down.svg"></span></a>
                        <div class="dropdown-menu">
                            <a href="#">Общая информация</a>
                            <a href="#">Настройка</a>
                            <a href="#">Ошибки</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a href="#">API <span><img src="img/arrow_down.svg"></span></a>
                        <div class="dropdown-menu">
                            <a href="#">Методы</a>
                            <a href="#">Авторизация</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a href="#">Обновления <span><img src="img/arrow_down.svg"></span></a>
                        <div class="dropdown-menu">
                            <a href="#">Версии</a>
                            <a href="#">История</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <div class="breadcrumb">
        <div class="container">
            <a href="index.php">Главная</a>
            <span class="breadcrumb-sep">›</span>
            <span>Раздел Такси-Мастер</span>
        </div>
    </div>
    <div class="page-layout">
        <div class="container page-layout__inner">
            <aside class="sidebar">
                <a href="taximaster.php" class="sidebar-item active">
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
                <a href="robot.php" class="sidebar-item">
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
                <a href="taximaster.php" class="back-link">← Назад</a>
                <h1 class="content-title"><?= $article['title'] ?></h1>
                <?php if ($article['file_type'] == 'html'): ?>
                    <?php include($article['file_path']); ?>
                <?php elseif ($article['file_type'] == 'pdf'): ?>
                    <iframe src="<?= $article['file_path'] ?>" width="100%" height="800px"></iframe>
                <?php endif; ?>
            <?php else: ?>
                <h1 class="content-title">Такси-Мастер</h1>
                <p class="content-description">
                    Здравствуйте! Это страница с документацией по программе «Такси-Мастер».
                </p>
                <div class="tabs">
                    <?php foreach ($tabs as $i => $tab): ?>
                        <button class="tab <?= $i === 0 ? 'active' : '' ?>" data-tab="<?= $tab['key_name'] ?>">
                            <?= $tab['title'] ?>
                        </button>
                    <?php endforeach; ?>
                </div>     
            <?php foreach ($tabs as $i => $tab): ?>
                <div class="tab-panel <?= $i === 0 ? 'active' : '' ?>" id="tab-<?= $tab['key_name'] ?>">
                    <ul class="content-list">
                        <?php if (!empty($articlesByCategory[$tab['key_name']])): ?>
                            <?php foreach ($articlesByCategory[$tab['key_name']] as $item): ?>
                                <li>
                                    <a href="taximaster.php?article=<?= $item['slug'] ?>">
                                        <?= $item['title'] ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li>Нет статей</li>
                        <?php endif; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
            <?php endif; ?>
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
            </main>
        </div>
    </div>
    <?php include("php/footer.php");?>
    <script src = "js/taximaster.js"></script>
</body>
</html>