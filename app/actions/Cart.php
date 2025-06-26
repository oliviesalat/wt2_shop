<?php

class Cart
{
    private static ?mysqli $db;

    public static function init(): void
    {
        self::$db = Database::db_connect();
    }

    public static function add_to_cart($product_id, $product_name, $quantity, $user_id): void
    {
        if (!self::$db) {
            self::init();
        }
        self::$db->begin_transaction();
        $query = "SELECT COUNT(*) FROM cart_items WHERE user_id = ?";
        $res = Database::db_fetch_single($query, 'i', $user_id);
        $count = $res["COUNT(*)"];

        if ($count < 5) {
            $stmt = self::$db->prepare("INSERT INTO cart_items (product_id, product_name, user_id, quantity) 
                            VALUES (?, ?, ?, ?)
                            ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity);");
            $stmt->bind_param("isii", $product_id, $product_name, $user_id, $quantity);
            if ($stmt->execute()) {
                $stmt->close();
                self::$db->commit();
                header('location: /cart');
                exit;
            } else {
                self::$db->rollback();
                die("Error: " . self::$db->error);
            }
        } else {
            self::$db->rollback();
            $_SESSION['error_cart'] = 'You already have 5 items in your cart.';
            header('location: /product?product_id=' . $product_id);
        }
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