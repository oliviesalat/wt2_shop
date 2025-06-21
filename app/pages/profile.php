<?php
include_once(__DIR__ . "/../templates/index_header.php");

if ($_SESSION['is_logged'] === false) {
    header('Location: /auth_page');
    exit;
}
$email = $_SESSION['email'] ;
echo "<h2>Hello, $email !</h2>";

echo "<a class='btn btn-outline-primary' href='/?action=logout'>Logout</a>";


include_once(__DIR__ . "/../templates/index_footer.php");