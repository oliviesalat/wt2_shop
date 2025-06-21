<?php
include_once(__DIR__ . "/../templates/index_header.php");

$_SESSION['is_logged'] = false;
unset($_SESSION['email']);
header("Location: /");

include_once(__DIR__ . "/../templates/index_footer.php");