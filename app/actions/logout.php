<?php

$_SESSION['is_logged'] = false;
unset($_SESSION['email']);
unset($_SESSION['user_id']);
unset($_SESSION['role_id']);
header("Location: /");
