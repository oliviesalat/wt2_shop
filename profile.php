<?php
include_once("index_header.php");

if ($_SESSION['is_logged'] === false) {
    header('Location: auth_page.php');
    exit;
}
$email = $_SESSION['email'] ;
echo "<h2>Hello $email !</h2>";

echo "<a class='btn btn-outline-primary' href='logout.php'>Logout</a>";


include_once("index_footer.php");