<?php
include_once(__DIR__ . "/../templates/index_header.php");

$db = Database::db_connect();

$email = trim($_POST["email"]);
$password = $_POST["password"];

$user = Database::db_fetch_single(
    "SELECT password FROM users WHERE email = ?",
    "s",
    $email
);
if (!$user) {
    die("User not found");
}
if (password_verify($password, $user['password'])) {
    $_SESSION['is_logged'] = true;
    $_SESSION['email'] = $email;
    header("Location: /profile");
} else {
    $_SESSION['is_logged'] = false;
    $_SESSION['error_message'] = "Wrong password";
    header("Location: /auth_page");
}
exit;