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
            <span>Раздел Центр обмена заказами TMMarket</span>
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
                <a href="tmmarket.php" class="sidebar-item active">
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
                <h1 class="content-title">Центр обмена заказами TMMarket</h1>
                <p class="content-description">
                    Центр обмена заказами (ЦОЗ) TMMarket — это автоматическая система для продажи и покупки заказов в службе такси. Она позволяет искать машину на заказ сразу во всех службах-участниках системы.
                </p>
                <div class="tab-panel active" id="tab-interested">
                    <ul class="content-list">
                        <li><a href="#">Центр обмена заказами</a></li>
                        <li><a href="#">Общая информация по работе с заказами из TMMarket</a></li>
                        <li><a href="#">Пополнение счета в ЦОЗ</a></li>
                        <li><a href="#">Инструкция по запросу списания с баланса ЦОЗ за услуги компании</a></li>
                        <li><a href="#">Схема работы центра обмена заказами</a></li>
                        <li><p>Интеграции ТММаркет:</p>
                            <ol><a href="#">РБТ</a></ol>
                            <ol><a href="#">UP&UP</a></ol></li>
                    </ul>
                </div>
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