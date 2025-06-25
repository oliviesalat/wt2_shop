<?php

class Database {
    private static ?mysqli $instance = null;
    private function __construct() {}
    private function __clone() {}
    public static function db_connect() : mysqli {
        if (self::$instance === null) {
            self::$instance = new mysqli("127.0.0.1", "root", "", "shop", 3306);
            if (self::$instance->connect_errno) {
                die("Connection failed: " . self::$instance->connect_errno . self::$instance->connect_error);
            }
            self::$instance->set_charset("utf8");
        }
        return self::$instance;
    }
    public static function db_fetch_all($query) {
        $stmt = self::$instance->prepare($query);
        if (!$stmt) {
            die("Failed to run query: " . self::$instance->error);
        }
        if (!$stmt->execute()) {
            die("Failed to execute query: " . $stmt->error);
        }
        $stmt_result = $stmt->get_result();
        $result = $stmt_result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $result;
    }

}





