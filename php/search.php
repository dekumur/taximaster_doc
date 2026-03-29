<?php
include("connect_db.php");

$query = trim($_GET['q'] ?? '');

if (strlen($query) < 2) {
    echo json_encode([]);
    exit;
}

$search = "%" . $query . "%";

$stmt = $conn->prepare("
    SELECT a.title, a.slug, s.slug AS section_slug, s.title AS section_title
    FROM articles a
    LEFT JOIN sections s ON a.section_id = s.id
    WHERE a.title LIKE ?
    ORDER BY a.title
    LIMIT 10
");
if (!$stmt) {
    echo json_encode([]);
    exit;
}

$stmt->bind_param("s", $search);
$stmt->execute();
$results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

echo json_encode($results);