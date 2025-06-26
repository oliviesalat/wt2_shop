<?php

class Database
{
    private static ?mysqli $instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function db_connect(): mysqli
    {
        if (self::$instance === null) {
            $host = getenv('DB_HOST') ?: '127.0.0.1';
            $user = getenv('DB_USER') ?: 'root';
            $pass = getenv('DB_PASS') ?: '';
            $name = getenv('DB_NAME') ?: 'shop';
            $port = getenv('DB_PORT') ?: 3306;
            self::$instance = new mysqli($host, $user, $pass, $name, $port);
            if (self::$instance->connect_errno) {
                die("Connection failed: " . self::$instance->connect_errno . self::$instance->connect_error);
            }
            self::$instance->set_charset("utf8");
        }
        return self::$instance;
    }

    public static function db_fetch_all(string $query, array $params = []): array
    {
        $stmt = self::$instance->prepare($query);
        if (!$stmt) {
            die("Failed to run query: " . self::$instance->error);
        }
        if (!empty($params)) {
            $stmt->bind_param($params['types'], ...$params['fields']);
        }
        if (!$stmt->execute()) {
            die("Failed to execute query: " . $stmt->error);
        }
        $stmt_result = $stmt->get_result();
        $result = $stmt_result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $result;
    }

    public static function db_fetch_single($query, $parameter_type, $parameter)
    {
        $stmt = self::$instance->prepare($query);
        if (!$stmt) {
            die("Failed to run query: " . self::$instance->error);
        }
        $stmt->bind_param($parameter_type, $parameter);
        if (!$stmt->execute()) {
            die("Failed to execute query: " . $stmt->error);
        }
        $stmt_result = $stmt->get_result();
        $result = $stmt_result->fetch_assoc();
        $stmt->close();
        return $result;
    }
    public static function insert($query, array $params = []): int {
        $stmt = self::$instance->prepare($query);
        if (!$stmt) {
            die("Failed to run query: " . self::$instance->error);
        }
        if (!empty($params)) {
            $stmt->bind_param($params['types'], ...$params['fields']);
        }
        if (!$stmt->execute()) {
            die("Failed to execute query: " . $stmt->error);
        }
        $affected_rows = $stmt->affected_rows;
        $stmt->close();
        return $affected_rows;
    }

}





