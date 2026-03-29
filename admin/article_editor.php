<?php
require("auth.php");
include("../php/connect_db.php");

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$article = null;
$success = false;
$error = '';

if ($id) {
    $stmt = $conn->prepare("SELECT * FROM articles WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $article = $stmt->get_result()->fetch_assoc();
}

$filePath = $article ? '../' . $article['file_path'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $filePath) {
    $content = $_POST['content'] ?? '';

    $dir = dirname($filePath);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }

    if (file_put_contents($filePath, $content) !== false) {
        $success = true;
    } else {
        $error = 'Не удалось сохранить файл. Проверьте права доступа к папке.';
    }
}

$fileContent = '';
if ($filePath && file_exists($filePath)) {
    $fileContent = file_get_contents($filePath);
} 
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/article_editor.css">
    <title>Редактор статьи</title>
</head>
<body>
<?php include("parts/sidebar.php"); ?>
<div class="admin-content">
    <?php include("parts/topbar.php"); ?>
    <main class="admin-main">

        <div class="page-header">
            <h1 class="page-title">Редактор статьи</h1>
            <a href="articles.php" class="btn btn-secondary">← К списку статей</a>
        </div>

        <?php if (!$article): ?>
            <div class="admin-form-card">
                <p style="color:#888">Статья не найдена. <a href="articles.php">Вернуться к статьям</a></p>
            </div>

        <?php else: ?>

            <?php if ($success): ?>
                <div class="alert alert-success">✓ Файл сохранён: <?= htmlspecialchars($article['file_path']) ?></div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="alert alert-error"><?= $error ?></div>
            <?php endif; ?>

            <?php if ($article['file_type'] !== 'html'): ?>
                <div class="file-missing">
                    ⚠️ Эта статья имеет тип <strong><?= strtoupper($article['file_type']) ?></strong>. 
                    Редактор работает только с HTML файлами.
                </div>
            <?php else: ?>

                <div class="editor-wrap">
                    <div class="editor-meta">
                        <h2><?= htmlspecialchars($article['title']) ?></h2>
                        <code><?= htmlspecialchars($article['file_path']) ?></code>
                    </div>

                    <?php if (!file_exists($filePath)): ?>
                        <div class="file-missing">
                            ⚠️ Файл <strong><?= htmlspecialchars($article['file_path']) ?></strong> не найден. 
                            Он будет создан автоматически при сохранении.
                        </div>
                    <?php endif; ?>

                    <form method="POST" id="editor-form">

                        <div class="tab-switcher">
                            <button type="button" class="active" onclick="switchMode('wysiwyg')">✏️ Редактор</button>
                            <button type="button" onclick="switchMode('code')">💻 HTML</button>
                            <button type="button" onclick="switchMode('preview')">👁 Предпросмотр</button>
                        </div>
                        <textarea id="wysiwyg-editor" name="content"><?= htmlspecialchars($fileContent) ?></textarea>
                        <textarea id="code-editor"><?= htmlspecialchars($fileContent) ?></textarea>
                        <div class="preview-box" id="preview-box"></div>

                        <div class="editor-actions">
                            <button type="submit" class="btn btn-primary">💾 Сохранить файл</button>
                        </div>

                    </form>
                </div>

            <?php endif; ?>

        <?php endif; ?>

    </main>
</div>

<script src="https://cdn.tiny.cloud/1/v5z9wbpb2nns7qgqb2info5ap20baa7l3631izrvikjhsfxd/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="js/editor.js"></script>
</body>
</html>