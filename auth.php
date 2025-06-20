<?php
include_once('index_header.php');
$db = Database::db_connect();

$email = trim($_POST["email"]);
$password = $_POST["password"];

$stmt = $db->prepare("SELECT password FROM users WHERE email = ?");
if (!$stmt) {
    die("Failed to run query: " . $db->error);
}
$stmt->bind_param("s", $email);
$stmt->execute();
if (!$stmt->execute()) {
    die("Failed to execute query: " . $stmt->error);
}
$stmt->bind_result($password_hash);
if ($stmt->fetch()) {
    if (password_verify($password, $password_hash)) {
        $_SESSION['is_logged'] = true;
        $_SESSION['email'] = $email;
        $stmt->close();
        header("Location: profile.php");
        exit;
    } else {
        $_SESSION['is_logged'] = false;
        $stmt->close();
        header("Location: auth_page.php");
        exit;
    }
}

include_once('index_footer.php');