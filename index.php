<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="icon" href="img/favicon.ico" type="image/ico">
    <title>Главная</title>
</head>
<body>
    <div class="modal-overlay" id="modal" style="display:none">
    <div class="modal">
        <button class="modal-close" onclick="document.getElementById('modal').style.display='none'">×</button>
        <div class="modal-left">
        <h2>Демоверсия Такси-Мастер<br>для диспетчера</h2>
        <p class="subtitle">Скачайте и ознакомьтесь с основными функциями</p>

        <ul class="steps">
            <li><span class="step-num">1</span> Запустите рабочее место диспетчера</li>
            <li><span class="step-num">2</span> Сформируйте отчеты «Водители», «Заказы», «Клиенты» и др.</li>
            <li><span class="step-num">3</span> Протестируйте инструменты «Справочники» для работы с экипажами, водителями, группами клиентов и т.д.</li>
            <li><span class="step-num">4</span> Создайте заказ с помощью программы «Такси-Мастер»</li>
            <li><span class="step-num">5</span><span>Подключите водительское приложение <a href="#">по инструкции</a>, чтобы принять заказ</span></li>
        </ul>
        <div class="modal-note">
            <span class="note-icon">i</span>
            <span>Всю информацию по установке продублируем на email</span>
        </div>
        </div>
        <div class="modal-right">
        <div class="badges">
            <div class="badge">
            <div class="badge-icon windows">🪟</div>
            <span>Может быть установлена <strong>только на Windows</strong></span>
            </div>
            <div class="badge">
            <div class="badge-icon info">ℹ️</div>
            <span>Имеет ограничения по сравнению с <a href="#">полной версией</a></span>
            </div>
            <div class="badge">
            <div class="badge-icon eye">👁</div>
            <span>Не предназначена для работы и носит <strong>ознакомительный характер</strong></span>
            </div>
        </div>
        <div class="divider"></div>
        <div class="form-group">
            <label>Электронная почта</label>
            <input type="email" placeholder="example@mail.com" required>
        </div>
        <div class="form-group">
            <label>Мобильный телефон</label>
            <input type="tel" placeholder="+7 (___) ___-__-__" required>
        </div>
        <button class="submit-btn">Скачать демоверсию</button>
        <div class="check-group">
        <label><input type="checkbox"><span>Предоставляя информацию, я соглашаюсь с <a href="#">обработкой персональных данных</a></span></label>
        <label><input type="checkbox"><span>Я согласен получать <a href="#">информационные и рекламные материалы</a> по Такси-Мастер</span></label>
        </div>
        </div>
    </div>
    </div>
    <header>
        <div class="container">
            <div class="header_wrap">
                <div class="logo">
                    <a href="index.php"><img src="img/logo.svg" alt="logo"></a>
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
    <section class="hero">
        <div class="container">
            <h1>Документация TaxiMaster</h1>
            <p>Найдите инструкции, настройте систему и решайте проблемы быстрее</p>
            <div class="search-box">
                <div class="input-wrap">
                    <img src="img/search.svg" alt="search">
                    <input type="text" placeholder="Что хотите найти? Например, системные требования">
                </div>
            </div>
            <button class="demo-btn" onclick="document.getElementById('modal').style.display='flex'">Бесплатная демо-версия</button>
        </div>
    </section>
    <section class="popular">
        <div class="container">
        <h2>ПОПУЛЯРНОЕ<span><img class="fire_icon" src="img/fire.svg" alt="fire"></span></h2>
        <div class="cards">
            <div class="card" data-video="https://www.youtube.com/embed/YBvcnPUUHnI">

                <img src="img/no-wifi.svg" alt="no-wifi" class="icon">
                <p>Как службам такси работать без интернета в 2025 году</p>
            </div>
            <div class="card" data-video="https://www.youtube.com/embed/KOoAvLPs0jY">
                <img src="img/driver.svg" alt="no-wifi" class="icon">
                <p>Как повысить мотивацию водителей</p>
            </div>
            <div class="card" data-video="https://www.youtube.com/embed/coLMyP8wB_U">
                <img src="img/no-wifi.svg" alt="no-wifi" class="icon">
                <p>Работа в такси как подработка: вся правда!</p>
            </div>
            <div class="card" data-video="https://youtu.be/o2ZCYtAAuYI?si=3-Xa3CSXrS2RhROR">
                <img src="img/no-wifi.svg" alt="no-wifi" class="icon">
                <p>Как службам такси работать без интернета в 2025 году</p>
            </div>
        </div>
        </div>
        <div class="video-container" id="videoContainer">
            <iframe id="videoFrame"
                src=""
                frameborder="0"
                allowfullscreen>
            </iframe>
        </div>
    </section>
    <section class="sections">
        <div class="container">
        <h2>РАЗДЕЛЫ</h2>

        <div class="section-grid">
            <div class="section-card">
                <img src="img/taximaster.png" alt="taximaster">
                <p>Программный комплекс <span>Такси Мастер</span></p>
            </div>
            <div class="section-card">
                <img src="img/taxophone.png" alt="taxophone">
                <p>Сервис TaxoPhone</p>
            </div>
            <div class="section-card">
                <img src="img/tmmarket.png" alt="tmmarket">
                <p>Центр обмена заказами <span>TMMarket</span></p>
            </div>
            <div class="section-card">
                <img src="img/tmdriver.png" alt="tmdriver">
                <p>Продвижение для водителей <span>TMDriver</span></p>
            </div>
            <div class="section-card">
                <img src="img/robot.png" alt="robot">
                <p>Сервис для обработки звонков <span>Голосовой робот</span></p>
            </div>
            <div class="section-card">
                <img src="img/web.png" alt="web">
                <p>Веб-сервисы <span>Такси Мастер</span></p>
            </div>
        </div>
        </div>
    </section>
    <section class="updates">
        <div class="container">
        <div class="updates-header">
            <h3>ОБНОВЛЕНИЕ СИСТЕМЫ</h3>
            <button>Смотреть все обновления</button>
        </div>
        <div class="update-box">
            <strong>Версия 3.16</strong>
            <ul>
                <li>Улучшена работа с водителями</li>
                <li>Новый алгоритм распределения заказов</li>
                <li>Исправление ошибок оплаты</li>
            </ul>
        </div> 
        </div>
    </section>
    <section class="support">
        <div class="container">
        <h3>НЕ НАШЛИ ОТВЕТ?</h3>
        <button>Связаться с техподдержкой</button>
    </div>
    </section>
    <footer class="footer">
        <div class="container">
        <div class="footer-grid">
            <div>
                <h4>Контакты</h4>
                <p>Ижевск, Советская, 12А</p>
                <p>info@tm-crm.ru</p>
                <p>+7 (499) 705-48-67</p>
            </div>

            <div>
                <h4>Популярные статьи из блога:</h4>
                <p>Законы о такси 2025</p>
                <p>Налог для такси</p>
                <p>Ошибки в заказах</p>
            </div>
        </div>

        <div class="copyright">
            © 2003–2026 «TaxiMaster»
        </div>
        </div>
    </footer>
    <script>
        document.querySelector('.demo-btn').onclick = () => {
        document.getElementById('modal').style.display = 'flex';
    }
    </script>
    <script src = "js/video.js"></script>
</body>
</html>