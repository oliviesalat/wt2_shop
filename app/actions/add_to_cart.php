<?php
require_once __DIR__ . '/Cart.php';

$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$quantity = $_POST['quantity'];
$user_id = $_SESSION['user_id'];

Cart::init();
Cart::add_to_cart($product_id, $product_name, $quantity, $user_id);


//
//
//$product_id = $_POST['product_id'];
//$product_name = $_POST['product_name'];
//$quantity = $_POST['quantity'];
//$user_id = $_SESSION['user_id'];
//
//$db = Database::db_connect();
//$db->begin_transaction();
//
//$query = "SELECT COUNT(*) FROM cart_items WHERE user_id = ?";
//$res = Database::db_fetch_single($query, 'i', $user_id);
//$count = $res["COUNT(*)"];
//
//
//if ($count < 5) {
//    $stmt = $db->prepare("INSERT INTO cart_items (product_id, product_name, user_id, quantity)
//                            VALUES (?, ?, ?, ?)
//                            ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity);");
//    $stmt->bind_param("isii", $product_id, $product_name, $user_id, $quantity);
//    if ($stmt->execute()) {
//        echo "$product_id added to cart ($quantity)";
//        $stmt->close();
//        $db->commit();
//        header('location: /cart');
//        exit;
//    } else {
//        die("Error: " . $stmt->error);
//    }
//
//} else {
//    $db->rollback();
//    echo "You can only have 5 unique products in the cart.";
//}
//
