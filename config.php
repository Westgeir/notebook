<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "записная книжка";

// Создаем подключение
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Проверяем подключение
if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");
?>
