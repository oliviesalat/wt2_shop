<?php


/*
$hostname = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "shop";
*/

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

}





