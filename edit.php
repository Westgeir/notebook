<?php
include 'config.php';

if (!isset($_GET['id'])) {
    echo "<p>Запись не выбрана для редактирования.</p>";
    exit;
}

$id = (int)$_GET['id'];
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $surname = trim($_POST['surname']);
    $name = trim($_POST['name']);
    $patronymic = trim($_POST['patronymic']);
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $phone = trim($_POST['phone']);

    $stmt = $conn->prepare("UPDATE contacts SET surname=?, name=?, patronymic=?, gender=?, birthdate=?, phone=? WHERE id=?");
    $stmt->bind_param("ssssssi", $surname, $name, $patronymic, $gender, $birthdate, $phone, $id);

    if ($stmt->execute()) {
        $message = "Запись успешно обновлена.";
    } else {
        $message = "Ошибка при обновлении: " . $conn->error;
    }
    $stmt->close();
}

$stmt = $conn->prepare("SELECT * FROM contacts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    echo "<p>Запись не найдена.</p>";
    exit;
}
$row = $result->fetch_assoc();
$stmt->close();
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

<h2>Редактировать запись</h2>
<div class="form-container">
<?php if ($message): ?>
    <div class="message"><?=htmlspecialchars($message)?></div>
<?php endif; ?>
<form method="post" action="">
    <label>Фамилия:
        <input type="text" name="surname" value="<?=htmlspecialchars($row['surname'])?>" required>
    </label>
    <label>Имя:
        <input type="text" name="name" value="<?=htmlspecialchars($row['name'])?>" required>
    </label>
    <label>Отчество:
        <input type="text" name="patronymic" value="<?=htmlspecialchars($row['patronymic'])?>">
    </label>
    <label>Пол:
        <select name="gender" required>
            <option value="М" <?=($row['gender'] == 'М') ? 'selected' : ''?>>Мужской</option>
            <option value="Ж" <?=($row['gender'] == 'Ж') ? 'selected' : ''?>>Женский</option>
        </select>
    </label>
    <label>Дата рождения:
        <input type="date" name="birthdate" value="<?=htmlspecialchars($row['birthdate'])?>" required>
    </label>
    <label>Телефон:
        <input type="text" name="phone" value="<?=htmlspecialchars($row['phone'])?>" required>
    </label>
    <input type="submit" value="Сохранить">
</form>
</div>