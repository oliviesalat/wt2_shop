<?php
require_once __DIR__ . '/../vendor/autoload.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['is_logged'] === false) {
    unset($_SESSION['email']);
}

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

include_once(__DIR__ . "/../config/Database.php");


// php -S localhost:8000 -t public;