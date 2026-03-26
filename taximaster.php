<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/taximaster.css">
    <link rel="icon" href="img/favicon.ico" type="image/ico">
    <title>Такси-Мастер - Документация</title>
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
                        <input type="text" placeholder="Найти информацию">
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
<div class="page">
    <aside>
        <div class="sidebar-item active">
            <img src="img/taximaster.png" alt="taximaster">
            Программный комплекс <span>Такси-Мастер</span>
        </div>
        <div class="sidebar-item">
            <img src="img/taxophone.png" alt="taxophone">
            Сервис TaxoPhone
        </div>
        <div class="sidebar-item">
            <img src="img/tmmarket.png" alt="tmmarket">
            Центр обмена заказами <span>TMMarket</span>
        </div>
        <div class="sidebar-item">
            <img src="img/tmdriver.png" alt="tmdriver">
            Продвижение для водителей <span>TMDriver</span>
        </div>
        <div class="sidebar-item">
            <img src="img/robot.png" alt="robot">
            Сервис для обработки звонков<br><span>Голосовой робот</span>
        </div>
        <div class="sidebar-item">
            <img src="img/web.png" alt="webservices">
            Веб-сервисы<span>Такси Мастер</span>
        </div>
    </aside>

    <main>
        <div class="content">

            <h1>Такси-Мастер</h1>

            <p class="intro-text">
                Здравствуйте! Это страница с документацией по программе «Такси-Мастер».
                Здесь собраны советы по работе и обслуживанию программы для пользователей любого уровня.
                По вопросам можно обратиться в техподдержку через
                <a href="#">Единый личный кабинет</a>.
            </p>

            <div class="tabs">
                <div class="tab active">Интересующимся</div>
                <div class="tab">Пользователям</div>
                <div class="tab">Бухгалтерам</div>
                <div class="tab">Видеоуроки</div>
                <div class="tab">Водителям</div>
                <div class="tab">Системным администраторам</div>
            </div>

            <p class="content-intro">
                В разделе представлена документация для потенциальных пользователей программы «Такси-Мастер».
            </p>

            <ul class="doc-list">
                <li>Системные требования</li>
                <li>Активация лицензионного ключа Такси-Мастер</li>
                <li>Дистрибутив</li>
                <li>Серверная часть Такси-Мастер</li>
                <li>Клиентская часть Такси-Мастер</li>
                <li>Карточка заказа</li>
                <li>Процесс внедрения Такси-Мастер</li>
                <li>Такси-Мастер CallCenter: функционал доступный по умолчанию</li>
            </ul>

            <div class="faq-section">
                <h2>Часто задаваемые вопросы</h2>

                <div class="faq-item">
                    <div class="faq-header" onclick="toggleFaq(this)">
                        Как обратиться в техническую поддержку
                        <span class="faq-arrow">▼</span>
                    </div>
                    <div class="faq-body">
                        Через личный кабинет или почту support@taximaster.ru
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-header" onclick="toggleFaq(this)">
                        Как узнать версию Такси-Мастера
                        <span class="faq-arrow">▼</span>
                    </div>
                    <div class="faq-body">
                        Справка → О программе
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-header" onclick="toggleFaq(this)">
                        Как настроить тариф
                        <span class="faq-arrow">▼</span>
                    </div>
                    <div class="faq-body">
                        Раздел Администрирование → Тарифы
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-header" onclick="toggleFaq(this)">
                        Как настроить сдачу с заказа
                        <span class="faq-arrow">▼</span>
                    </div>
                    <div class="faq-body">
                        Настройки → Расчёт стоимости
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-header" onclick="toggleFaq(this)">
                        Как перенести сервер на другой компьютер
                        <span class="faq-arrow">▼</span>
                    </div>
                    <div class="faq-body">
                        Сделать бэкап, установить сервер и восстановить
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>
<?php include("php/footer.php");?>
<script>
    function toggleFaq(header) {
        const item = header.parentElement;
        item.classList.toggle('open');
    }
    document.querySelectorAll('.tab').forEach(tab => {
        tab.addEventListener('click', () => {
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
        });
    });
</script>
</body>
</html>