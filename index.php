<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f9f9f9;
    margin: 0;
    padding: 20px;
    color: #333;
}

.menu {
    margin-bottom: 20px;
}
.menu-button {
    display: inline-block;
    padding: 10px 20px;
    margin-right: 12px;
    background-color: #007BFF;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-weight: 600;
    transition: background-color 0.3s ease;
}
.menu-button:hover {
    background-color: #0056b3;
}
.menu-button.active {
    background-color: #dc3545;
}
h2 {
    color: #222;
    margin-bottom: 15px;
}
table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}
table th, table td {
    padding: 12px 15px;
    border: 1px solid #ddd;
    text-align: left;
}
table th {
    background-color: #f4f6f8;
    font-weight: 700;
}
table tr:nth-child(even) {
    background-color: #f9f9f9;
}
table tr:hover {
    background-color: #e9f2ff;
}
form {
    background: #fff;
    padding: 20px;
    max-width: 500px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
form label {
    display: block;
    margin-bottom: 10px;
    font-weight: 600;
}
form input[type="text"],
form input[type="date"],
form select {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 1rem;
    margin-top: 4px;
    margin-bottom: 15px;
    transition: border-color 0.3s ease;
}
form input[type="text"]:focus,
form input[type="date"]:focus,
form select:focus {
    border-color: #007BFF;
    outline: none;
}
form input[type="submit"] {
    background-color: #007BFF;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-weight: 600;
    transition: background-color 0.3s ease;
}
form input[type="submit"]:hover {
    background-color: #0056b3;
}
.pagination {
    margin-top: 20px;
}
.pagination a,
.pagination strong {
    display: inline-block;
    padding: 8px 12px;
    margin-right: 8px;
    border-radius: 4px;
    text-decoration: none;
    border: 1px solid transparent;
    font-weight: 600;
}
.pagination a {
    color: #007BFF;
    border-color: #007BFF;
    transition: background-color 0.3s ease, color 0.3s ease;
}
.pagination a:hover {
    background-color: #007BFF;
    color: white;
}
.pagination strong {
    background-color: #007BFF;
    color: white;
    border-color: #007BFF;
}
@media (max-width: 600px) {
    body {
        padding: 10px;
    }
    form, table {
        width: 100%;
        font-size: 14px;
    }
    .menu-button {
        margin-bottom: 10px;
        display: block;
    }
}
</style>

<?php
include 'menu.php';
$action = isset($_GET['action']) ? $_GET['action'] : 'view';

switch ($action) {
    case 'view':
        include 'viewer.php';
        break;
    case 'add':
        include 'add.php';
        break;
    case 'edit':
        include 'edit.php';
        break;
    case 'delete':
        include 'delete.php';
        break;
    default:
        echo "<p>Неизвестное действие</p>";
}
?>
