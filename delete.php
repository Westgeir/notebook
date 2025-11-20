<?php
include 'config.php';

$message = '';
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $conn->prepare("DELETE FROM contacts WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $message = "Запись успешно удалена.";
    } else {
        $message = "Ошибка удаления: " . $conn->error;
    }
    $stmt->close();
}

$result = mysqli_query($conn, "SELECT id, surname, name FROM contacts ORDER BY surname");
?>

<style>
.delete-list {
    max-width: 620px;
    background: #ffffff;
    padding: 22px 28px;
    margin: 20px auto;
    border-radius: 12px;
    box-shadow: 0 2px 18px rgba(0,0,0,0.07);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
.delete-list ul {
    list-style: none;
    padding-left: 0;
    margin: 0;
}
.delete-list ul li {
    padding: 14px 18px;
    border-bottom: 1px solid #e2e2e2;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: 600;
    color: #444;
}
.delete-list ul li:last-child {
    border-bottom: none;
}
.delete-link {
    background-color: #d9534f;
    color: white;
    padding: 7px 18px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 700;
    transition: background-color 0.3s ease;
}
.delete-link:hover {
    background-color: #a94442;
}
.message {
    margin-bottom: 22px;
    font-weight: 700;
    color: #2d7a48;
    text-align: center;
}
</style>

<h2>Удалить запись</h2>
<div class="delete-list">
<?php if ($message): ?>
    <div class="message"><?=htmlspecialchars($message)?></div>
<?php endif; ?>
<ul>
<?php while ($row = mysqli_fetch_assoc($result)): ?>
    <li>
        <?=htmlspecialchars($row['surname'])?> <?=htmlspecialchars($row['name'])?>
        <a class="delete-link" href="?action=delete&id=<?=$row['id']?>" onclick="return confirm('Вы уверены, что хотите удалить эту запись?')">Удалить</a>
    </li>
<?php endwhile; ?>
</ul>
</div>