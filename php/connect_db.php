<?php
$conn = new mysqli("127.0.0.1", "root", "", "taximaster_doc");
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
?>