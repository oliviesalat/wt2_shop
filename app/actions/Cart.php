<?php

use JetBrains\PhpStorm\NoReturn;

class Cart
{
    private static ?mysqli $db;

    public static function init(): void
    {
        self::$db = Database::db_connect();
    }

    #[NoReturn] public static function add_to_cart($product_id, $product_name, $quantity, $user_id): void
    {
        if (!self::$db) {
            self::init();
        }
        self::$db->begin_transaction();
        $stmt = self::$db->prepare("INSERT INTO cart_items (product_id, product_name, user_id, quantity)
            SELECT ?, ?, ?, ?
            FROM DUAL   
            WHERE ( 
            (SELECT COUNT(*) FROM cart_items WHERE user_id = ?) < 5
            OR EXISTS (
            SELECT 1 FROM cart_items WHERE user_id = ? AND product_id = ?))
            ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity);");
        $stmt->bind_param(
            "isiiiii",
            $product_id,
            $product_name,
            $user_id,
            $quantity,
            $user_id,
            $user_id,
            $product_id
        );
        if (!$stmt->execute()) {
            self::$db->rollback();
            die("Execute failed: " . $stmt->error);
        }
        if ($stmt->affected_rows === 0) {
            self::$db->rollback();
            $_SESSION['error_cart'] = 'You already have 5 items in your cart.';
            header('location: /product?product_id=' . $product_id);
            exit;
        }
        $stmt->close();

        self::$db->commit();

        header('location: /cart');
        exit;
    }

    public static function remove_from_cart($product_id, $user_id): void
    {
        if (!self::$db) {
            self::init();
        }
        $query = "DELETE FROM cart_items WHERE product_id = ? AND user_id = ?";
        $stmt = self::$db->prepare($query);
        if (!$stmt) {
            die("Error: " . self::$db->error);
        }
        $stmt->bind_param("ii", $product_id, $user_id);
        if (!$stmt->execute()) {
            die("Error: " . self::$db->error);
        }
        $stmt->close();
    }

    public static function edit_quantity($product_id, $user_id, $new_quantity): void
    {
        if (!self::$db) {
            self::init();
        }
        $query = "UPDATE cart_items SET quantity = ? WHERE product_id = ? AND user_id = ?";
        $stmt = self::$db->prepare($query);
        if (!$stmt) {
            die("Error: " . self::$db->error);
        }
        $stmt->bind_param("iii", $new_quantity, $product_id, $user_id);
        if (!$stmt->execute()) {
            die("Error: " . self::$db->error);
        }
        $stmt->close();
    }
}