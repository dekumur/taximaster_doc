<?php
require("auth.php");
include("../php/connect_db.php");

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$article = null;
$success = false;

if ($id) {
    $stmt = $conn->prepare("SELECT * FROM articles WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $article = $stmt->get_result()->fetch_assoc();
}

$sections = $conn->query("SELECT * FROM sections ORDER BY title")->fetch_all(MYSQLI_ASSOC);
$categories = $conn->query("SELECT * FROM categories ORDER BY section_id, sort_order")->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title     = trim($_POST['title']);
    $slug      = trim($_POST['slug']);
    $section_id= (int)$_POST['section_id'];
    $category  = trim($_POST['category'] ?? '');
    $file_type = trim($_POST['file_type']);
    $file_path = trim($_POST['file_path']);

    if ($id) {
        $stmt = $conn->prepare("UPDATE articles SET title=?, slug=?, section_id=?, category=?, file_type=?, file_path=? WHERE id=?");
        $stmt->bind_param("ssisssi", $title, $slug, $section_id, $category, $file_type, $file_path, $id);
    } else {
        $stmt = $conn->prepare("INSERT INTO articles (title, slug, section_id, category, file_type, file_path) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssisss", $title, $slug, $section_id, $category, $file_type, $file_path);
    }

    $stmt->execute();
    $success = true;
    if (!$id) {
        header("Location: articles.php");
        exit;
    }
    $article = ['title'=>$title,'slug'=>$slug,'section_id'=>$section_id,'category'=>$category,'file_type'=>$file_type,'file_path'=>$file_path];
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/admin.css">
    <title><?= $id ? 'Редактировать статью' : 'Новая статья' ?></title>
</head>
<body>
<?php include("parts/sidebar.php"); ?>
<div class="admin-content">
    <?php include("parts/topbar.php"); ?>
    <main class="admin-main">
        <div class="page-header">
            <h1 class="page-title"><?= $id ? 'Редактировать статью' : 'Новая статья' ?></h1>
            <a href="articles.php" class="btn btn-secondary">← Назад</a>
        </div>

        <?php if ($success): ?>
            <div class="alert alert-success">Сохранено!</div>
        <?php endif; ?>

        <div class="admin-form-card">
            <form method="POST">
                <div class="form-group">
                    <label>Название</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($article['title'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label>Slug (URL)</label>
                    <input type="text" name="slug" value="<?= htmlspecialchars($article['slug'] ?? '') ?>" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Раздел</label>
                        <select name="section_id">
                            <?php foreach ($sections as $s): ?>
                                <option value="<?= $s['id'] ?>" <?= ($article['section_id'] ?? '') == $s['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($s['title']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Категория (таб)</label>
                        <select name="category" id="category_select">
                            <option value="">— без категории —</option>
                            <?php foreach ($categories as $c): ?>
                                <option 
                                    value="<?= htmlspecialchars($c['key_name']) ?>"
                                    data-section="<?= $c['section_id'] ?>"
                                    <?= ($article['category'] ?? '') == $c['key_name'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($c['title']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Тип файла</label>
                        <select name="file_type">
                            <option value="html" <?= ($article['file_type'] ?? '') == 'html' ? 'selected' : '' ?>>HTML</option>
                            <option value="pdf"  <?= ($article['file_type'] ?? '') == 'pdf'  ? 'selected' : '' ?>>PDF</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Путь к файлу</label>
                        <input type="text" name="file_path" value="<?= htmlspecialchars($article['file_path'] ?? '') ?>" placeholder="articles/my-article.pdf">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
    </main>
</div>
<script>
function filterCategories() {
    const sectionId = document.getElementById('section_select').value;
    const options = document.querySelectorAll('#category_select option');

    options.forEach(opt => {
        const sec = opt.getAttribute('data-section');
        if (!sec || sec === sectionId) {
            opt.style.display = '';
        } else {
            opt.style.display = 'none';
        }
    });

    const selected = document.querySelector('#category_select option:checked');
    if (selected && selected.getAttribute('data-section') && selected.getAttribute('data-section') !== sectionId) {
        document.getElementById('category_select').value = '';
    }
}

filterCategories();
</script>
</body>
</html>