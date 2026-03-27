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
            <span>Сервис TaxoPhone</span>
        </div>
    </div>
    <div class="page-layout">
        <div class="container page-layout__inner">
            <aside class="sidebar">
                <a href="taximaster.php" class="sidebar-item">
                    <span class="sidebar-icon"><img src="img/taximaster.png" alt=""></span>
                    <span>Программный комплекс <strong>Такси-Мастер</strong></span>
                </a>
                <a href="taxophone.php" class="sidebar-item active">
                    <span class="sidebar-icon"><img src="img/taxophone.png" alt=""></span>
                    <span>Сервис <strong>TaxoPhone</strong></span>
                </a>
                <a href="tmmarket.php" class="sidebar-item">
                    <span class="sidebar-icon"><img src="img/tmmarket.png" alt=""></span>
                    <span>Центр обмена заказами <strong>TMMarket</strong></span>
                </a>
                <a href="tmdriver.php" class="sidebar-item">
                    <span class="sidebar-icon"><img src="img/tmdriver.png" alt=""></span>
                    <span>Продвижение для водителей <strong>TMDriver</strong></span>
                </a>
                <a href="robot.php" class="sidebar-item">
                    <span class="sidebar-icon"><img src="img/robot.png" alt=""></span>
                    <span>Сервис для обработки звонков <strong>Голосовой робот</strong></span>
                </a>
                <a href="web.php" class="sidebar-item">
                    <span class="sidebar-icon"><img src="img/web.png" alt=""></span>
                    <span>Веб-сервисы <strong>Такси Мастер</strong></span>
                </a>
            </aside>
            <main class="content-area">
                <h1 class="content-title">TaxoPhone</h1>
                <ul class="content-list">
                    <li><a href="#">История изменений в приложении TaxoPhone</a></li>
                    <li><a href="#">Обзор возможностей приложения TaxoPhone</a></li>
                    <li><a href="#">Настройки влияющие на работу TaxoPhone</a></li>
                    <li><a href="#">Настройки TaxoPhone в Такси-Мастер</a></li>
                    <li><a href="#">Реферальная система клиентов</a></li>
                    <li><a href="#">Настройка промокодов</a></li>
                    <li><a href="#">Бонусная система для клиентов, примеры её использования</a></li>
                    <li><a href="#">Семейный счёт</a></li>
                    <li><a href="#">Совместные поездки</a></li>
                    <li><a href="#">Заказы-аукционы</a></li>
                    <li><a href="#">Отчёт «Заказы через Таксофон. Отзывы клиентов»</a></li>
                    <li><a href="#">AppMetrica</a></li>
                    <li><a href="#">Шаблон E-mail для отправки чека</a></li>
                </ul>
                <div class="info-box">
                    <p>Анкеты для создания или обновления приложения Вы можете заполнить на сайте:
                        <a href="http://taxophone.taximaster.ru/" target="_blank" class="ext-link">
                            http://taxophone.taximaster.ru/
                            <img src="img/external.svg" alt="" class="ext-icon">
                        </a>
                    </p>
                    <p>Утилита выбора цвета:
                        <a href="http://www.taximaster.ru/taxophone-color-editor/" target="_blank" class="ext-link">
                            http://www.taximaster.ru/taxophone-color-editor/
                            <img src="img/external.svg" alt="" class="ext-icon">
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

            </main>
        </div>
    </div>
    <?php include("php/footer.php");?>
    <script src = "js/taximaster.js"></script>
</body>
</html>