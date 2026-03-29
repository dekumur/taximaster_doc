<aside class="admin-sidebar">
    <div class="sidebar-logo">
        <a href="../index.php" target="_blank">TaxiMaster</a>
        <span>Админпанель</span>
    </div>
    <nav class="sidebar-nav">
        <a href="index.php" class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">
            🏠 Дашборд
        </a>
        <a href="articles.php" class="<?= str_contains($_SERVER['PHP_SELF'], 'article') ? 'active' : '' ?>">
            📄 Статьи
        </a>
        <a href="sections.php" class="<?= str_contains($_SERVER['PHP_SELF'], 'section') ? 'active' : '' ?>">
            📁 Разделы
        </a>
        <a href="categories.php" class="<?= str_contains($_SERVER['PHP_SELF'], 'categor') ? 'active' : '' ?>">
            🗂 Категории
        </a>
        <a href="updates.php" class="<?= str_contains($_SERVER['PHP_SELF'], 'update') ? 'active' : '' ?>">
            🔄 Обновления
        </a>
    </nav>
    <a href="logout.php" class="sidebar-logout">🚪 Выйти</a>
</aside>