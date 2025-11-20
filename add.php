<?php
include 'config.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $surname = trim($_POST['surname']);
    $name = trim($_POST['name']);
    $patronymic = trim($_POST['patronymic']);
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $phone = trim($_POST['phone']);

    $stmt = $conn->prepare("INSERT INTO contacts (surname, name, patronymic, gender, birthdate, phone) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $surname, $name, $patronymic, $gender, $birthdate, $phone);
    if ($stmt->execute()) {
        $message = "Запись успешно добавлена.";
    } else {
        $message = "Ошибка при добавлении: " . $conn->error;
    }
    $stmt->close();
}
?>

<style>
.form-container {
    max-width: 520px;
    background: #ffffff;
    padding: 28px 30px;
    border-radius: 12px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    margin: 20px auto;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
form label {
    display: block;
    margin-bottom: 14px;
    font-weight: 700;
    color: #444444;
}
form input[type="text"],
form input[type="date"],
form select {
    width: 100%;
    padding: 9px 15px;
    border-radius: 8px;
    border: 1px solid #d1d5db;
    margin-top: 7px;
    margin-bottom: 20px;
    font-size: 1rem;
    box-sizing: border-box;
    transition: border-color 0.3s ease;
}
form input:focus, form select:focus {
    outline: none;
    border-color: #4a90e2;
}
form input[type="submit"] {
    background-color: #4a90e2;
    color: white;
    padding: 14px 28px;
    font-weight: 700;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
form input[type="submit"]:hover {
    background-color: #356db8;
}
.message {
    margin-bottom: 25px;
    font-weight: 700;
    color: #2d7a48;
    text-align: center;
}
</style>

<h2>Добавить новую запись</h2>
<div class="form-container">
    <?php if ($message): ?>
    <div class="message"><?=htmlspecialchars($message)?></div>
    <?php endif; ?>
    <form method="post" action="">
        <label>Фамилия:
            <input type="text" name="surname" required>
        </label>
        <label>Имя:
            <input type="text" name="name" required>
        </label>
        <label>Отчество:
            <input type="text" name="patronymic">
        </label>
        <label>Пол:
            <select name="gender" required>
                <option value="М">Мужской</option>
                <option value="Ж">Женский</option>
            </select>
        </label>
        <label>Дата рождения:
            <input type="date" name="birthdate" required>
        </label>
        <label>Телефон:
            <input type="text" name="phone" required>
        </label>
        <input type="submit" value="Добавить">
    </form>
</div>