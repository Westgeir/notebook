<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "записная книжка";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");
?>
