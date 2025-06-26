<?php

$_SESSION['is_logged'] = false;
unset($_SESSION['email']);
unset($_SESSION['user_id']);
header("Location: /");
