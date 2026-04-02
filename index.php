<?php
include("php/connect_db.php");

$stmt = $conn->prepare("SELECT * FROM updates ORDER BY sort_order DESC LIMIT 1");
if (!$stmt) die("Ошибка: " . $conn->error);
$stmt->execute();
$latestUpdate = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/index.css">
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
<div class="modal-overlay" id="support-modal" style="display:none">
    <div class="modal modal-support">
        <button class="modal-close" onclick="document.getElementById('support-modal').style.display='none'">×</button>
        <div class="modal-left">
            <h2>Связаться с техподдержкой</h2>
            <p class="subtitle">Опишите проблему и мы свяжемся с вами в ближайшее время</p>
        </div>
        <div class="modal-right">
            <div class="form-group">
                <label>Ваш ИД</label>
                <input type="text" placeholder="0000">
            </div>
            <div class="form-group">
                <label>Ваше имя</label>
                <input type="text" placeholder="Иван Иванов">
            </div>
            <div class="form-group">
                <label>Электронная почта</label>
                <input type="email" placeholder="example@mail.com">
            </div>
            <div class="form-group">
                <label>Мобильный телефон</label>
                <input type="tel" placeholder="+7 (___) ___-__-__">
            </div>
            <div class="form-group">
                <label>Опишите проблему</label>
                <textarea placeholder="Подробно опишите вашу проблему..." rows="4"></textarea>
            </div>
            <button class="submit-btn">Отправить заявку</button>
            <div class="check-group">
                <label>
                    <input type="checkbox">
                    <span>Я согласен с <a href="#">обработкой персональных данных</a></span>
                </label>
            </div>
        </div>
    </div>
</div>
    <?php include("php/header.php");?>
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
                <img src="img/driver.svg" alt="motivation" class="icon">
                <p>Как повысить мотивацию водителей</p>
            </div>
            <div class="card" data-video="https://www.youtube.com/embed/coLMyP8wB_U">
                <img src="img/no-wifi.svg" alt="true" class="icon">
                <p>Работа в такси как подработка: вся правда!</p>
            </div>
            <div class="card" data-video="https://www.youtube.com/embed/8RF3avKXqZM">
                <img src="img/no-wifi.svg" alt="telephone" class="icon">
                <p>Телефония для такси: современное решение от Такси-Мастер</p>
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
            <a href="taximaster.php" class="section-card">
                <img src="img/taximaster.webp" alt="taximaster" loading="lazy">
                <p>Программный комплекс <span>Такси Мастер</span></p>
            </a>
            <a href="taxophone.php" class="section-card">
                <img src="img/taxophone.png" alt="taxophone" loading="lazy">
                <p>Сервис TaxoPhone</p>
            </a>
            <a href="tmmarket.php" class="section-card">
                <img src="img/tmmarket.webp" alt="tmmarket" loading="lazy" >
                <p>Центр обмена заказами <span>TMMarket</span></p>
            </a>
            <a href="tmdriver.php" class="section-card">
                <img src="img/tmdriver.webp" alt="tmdriver"loading="lazy" >
                <p>Продвижение для водителей <span>TMDriver</span></p>
            </a>
            <a href="robot.php" class="section-card">
                <img src="img/robot.png" alt="robot" loading="lazy">
                <p>Сервис для обработки звонков <span>Голосовой робот</span></p>
            </a>
            <a href="web.php" class="section-card">
                <img src="img/web.png" alt="web" loading="lazy">
                <p>Веб-сервисы <span>Такси Мастер</span></p>
            </a>
        </div>
        </div>
    </section>
    <section class="updates">
        <div class="container">
            <h3>ОБНОВЛЕНИЕ СИСТЕМЫ</h3>
            <div class="update-box">
                <div class="update-box-header">
                    <strong>Версия 3.16</strong>
                    <a href="updates.php" class="btn-all-updates">Смотреть все обновления</a>
                </div>
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
            <button onclick="document.getElementById('support-modal').style.display='flex'">
                <span><img src="img/sms.svg" alt="sms" loading="lazy"></span>
                Связаться с техподдержкой
            </button>
        </div>
    </section>
    <?php include("php/footer.php");?>
    <script>
        document.querySelector('.demo-btn').onclick = () => {
        document.getElementById('modal').style.display = 'flex';
    }
    </script>
    <script src = "js/video.js"></script>
    <script src="js/search.js"></script>
</body>
</html>