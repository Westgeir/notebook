<?php
$current_action = isset($_GET['action']) ? $_GET['action'] : 'view';

function menu_item($name, $action, $current_action) {
    $class = ($action == $current_action) ? 'active' : '';
    echo "<a href='?action=$action' class='menu-button $class'>$name</a>";
}
?>

<style>
.menu {
    margin-bottom: 20px;
    background: #ffffff;
    padding: 12px 18px;
    border-radius: 10px;
    box-shadow: 0 1px 6px rgba(0,0,0,0.08);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
.menu-button {
    display: inline-block;
    padding: 10px 24px;
    margin-right: 14px;
    background-color: #4a90e2;
    color: #fdfdfd;
    text-decoration: none;
    border-radius: 7px;
    font-weight: 600;
    box-shadow: 0 2px 8px rgba(74,144,226,0.3);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
}
.menu-button:hover {
    background-color: #3a76c2;
    box-shadow: 0 3px 12px rgba(58,118,194,0.5);
}
.menu-button.active {
    background-color: #d9534f;
    box-shadow: 0 3px 12px rgba(217,83,79,0.5);
}
@media (max-width: 600px) {
    .menu-button {
        display: block;
        margin-bottom: 12px;
        margin-right: 0;
    }
}
</style>

<div class="menu">
<?php
menu_item('Просмотр', 'view', $current_action);
menu_item('Добавить запись', 'add', $current_action);
//menu_item('Редактировать запись', 'edit', $current_action);
menu_item('Удалить запись', 'delete', $current_action);
?>
</div>