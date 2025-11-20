<?php
include 'config.php';

$sort_by = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$per_page = 10;
$offset = ($page - 1) * $per_page;

$allowed_sort = ['id', 'surname', 'birthdate'];
$order = in_array($sort_by, $allowed_sort) ? $sort_by : 'id';

$query = "SELECT * FROM contacts ORDER BY $order LIMIT $per_page OFFSET $offset";
$result = mysqli_query($conn, $query);
?>

<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #fafafa;
    color: #333333;
    padding: 15px;
}
h2 {
    margin-bottom: 15px;
}
table.contacts-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 8px;
    background: #ffffff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 1px 8px rgba(0,0,0,0.06);
}
table.contacts-table th, table.contacts-table td {
    padding: 15px 20px;
    background-color: #fff;
}
table.contacts-table th {
    font-weight: 700;
    color: #4a4a4a;
    border-bottom: 2px solid #e2e2e2;
    text-align: left;
}
table.contacts-table tr {
    transition: background-color 0.3s;
    box-shadow: 0 2px 5px rgba(0,0,0,0.04);
    border-radius: 8px;
}
table.contacts-table tr:hover td {
    background-color: #f0f6fc;
}
a.action-link {
    margin-right: 10px;
    color: #4a90e2;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}
a.action-link:hover {
    color: #205a9c;
}
.pagination {
    margin-top: 20px;
    text-align: center;
}
.pagination a, .pagination strong {
    margin: 0 6px;
    padding: 9px 14px;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    border: 1px solid transparent;
    color: #4a90e2;
}
.pagination a {
    border-color: #4a90e2;
    transition: all 0.3s ease;
}
.pagination a:hover {
    background-color: #4a90e2;
    color: #fff;
    border-color: #4a90e2;
}
.pagination strong {
    background-color: #4a90e2;
    color: #fff;
    border-color: #4a90e2;
    cursor: default;
}
</style>

<h2>Записи контактов</h2>
<table class="contacts-table" cellspacing="0" cellpadding="0">
    <thead>
        <tr>
            <th><a href="?action=view&sort=surname">Фамилия</a></th>
            <th>Имя</th>
            <th>Отчество</th>
            <th>Пол</th>
            <th><a href="?action=view&sort=birthdate">Дата рождения</a></th>
            <th>Телефон</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?=htmlspecialchars($row['surname'])?></td>
            <td><?=htmlspecialchars($row['name'])?></td>
            <td><?=htmlspecialchars($row['patronymic'])?></td>
            <td><?=htmlspecialchars($row['gender'])?></td>
            <td><?=htmlspecialchars($row['birthdate'])?></td>
            <td><?=htmlspecialchars($row['phone'])?></td>
            <td>
                <a class="action-link" href="?action=edit&id=<?=$row['id']?>">Редактировать</a>
                <a class="action-link" href="?action=delete&id=<?=$row['id']?>">Удалить</a>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

<?php
$result_total = mysqli_query($conn, "SELECT COUNT(*) AS total FROM contacts");
$total_rows = mysqli_fetch_assoc($result_total)['total'];
$total_pages = ceil($total_rows / $per_page);
?>

<div class="pagination">
<?php for($i = 1; $i <= $total_pages; $i++): ?>
    <?php if($i == $page): ?>
        <strong><?=$i?></strong>
    <?php else: ?>
        <a href="?action=view&page=<?=$i?>"><?=$i?></a>
    <?php endif; ?>
<?php endfor; ?>
</div>