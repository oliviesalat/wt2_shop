<?php
require_once __DIR__ . '/Cart.php';

$product_id = $_POST['product_id'] ?? "";
$product_name = $_POST['product_name'] ?? "";
$quantity = $_POST['quantity'] ?? "";
$user_id = $_SESSION['user_id'];

Cart::init();
$action = $_GET["action"];
switch ($action) {
    case "add_to_cart":
        Cart::add_to_cart($product_id, $product_name, $quantity, $user_id);
        break;
    case "remove_from_cart":
        Cart::remove_from_cart($product_id, $user_id);
        header("Location: /cart");
        break;
    case "edit_quantity":
        Cart::edit_quantity($product_id, $user_id, $quantity);
        header("Location: /cart");
        break;
    default:
        break;
}
