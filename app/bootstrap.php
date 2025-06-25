<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['is_logged'] === false) {
    unset($_SESSION['email']);
}

include_once(__DIR__ . "/../config/Database.php");
