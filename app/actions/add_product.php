<?php

$action = $_GET["action"];
$name = $_POST["name"];
$category_id = $_POST["category_id"];
$description = $_POST["description"];
$price = $_POST["price"];

$db = Database::db_connect();
$rows_count = Database::insert(
    "INSERT INTO products (name, category_id, description, price) VALUES (?, ?, ?, ?)",
    [
        'types' => 'sisd',
        'fields' => [$name, $category_id, $description, $price]
    ]
);

if ($rows_count > 0) {
    $_SESSION['added_product'] = $name;
} else {
    $_SESSION['added_product'] = '';
}
header("Location: /admin_panel");
exit;