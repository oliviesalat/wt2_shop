<?php
include_once (__DIR__ . "/../app/bootstrap.php");

$action = $_GET['action'] ?? '';
if ($action) {
    switch ($action) {
        case 'auth':
            include_once (__DIR__ . "/../app/actions/auth.php");
            break;
        case 'logout':
            include_once (__DIR__ . "/../app/actions/logout.php");
            break;
        default:
            include_once __DIR__ . '/../app/pages/home.php';
            break;
    }
    exit;
}

//$uri = $_SERVER['REQUEST_URI'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/':
        include __DIR__ . '/../app/pages/home.php';
        break;
    case '/auth_page':
        include __DIR__ . '/../app/pages/auth.php';
        break;
    case '/registration_page':
        include __DIR__ . '/../app/pages/registration.php';
        break;
    case '/profile':
        include __DIR__ . '/../app/pages/profile.php';
        break;
    case '/products':
        include __DIR__ . '/../app/pages/products.php';
        break;
    case 'product':
        include __DIR__ . '/../app/pages/product.php';
        break;
    default:
        http_response_code(404);
        echo "404 Not Found";
}



