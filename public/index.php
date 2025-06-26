<?php
include_once(__DIR__ . "/../app/bootstrap.php");

$action = $_GET['action'] ?? '';
if ($action) {
    switch ($action) {
        case 'auth':
            include_once(__DIR__ . "/../app/actions/auth.php");
            break;
        case 'register':
            include_once(__DIR__ . "/../app/actions/register.php");
            break;
        case 'logout':
            include_once(__DIR__ . "/../app/actions/logout.php");
            break;
        case 'remove_from_cart':
        case 'add_to_cart':
        case 'edit_quantity':
            include_once(__DIR__ . "/../app/actions/cart_action.php");
            break;
        case 'place_order':
            include_once(__DIR__ . "/../app/actions/place_order.php");
            break;
        case 'add_product':
            include_once(__DIR__ . "/../app/actions/add_product.php");
            break;
        default:
            include_once __DIR__ . '/../app/pages/home.php';
            break;
    }
    exit;
}


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
    case '/product':
        include __DIR__ . '/../app/pages/product.php';
        break;
    case '/cart':
        include __DIR__ . '/../app/pages/cart.php';
        break;
    case '/order_success':
        include __DIR__ . '/../app/pages/order_success.php';
        break;
    case '/orders_page':
        include __DIR__ . '/../app/pages/orders_page.php';
        break;
    case '/admin_panel':
        include __DIR__ . '/../app/pages/admin_panel.php';
        break;
    default:
        http_response_code(404);
        echo "404 Not Found";
}



