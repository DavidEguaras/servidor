<?php

// Incluir los archivos de configuración
require_once 'config/configBD.php';
require_once 'config/config.php';

$users = UserDAO::getAllUsers();
print_r($users);




// Verificar accion
if (isset($_SERVER['PATH_INFO'])) {
    // Obtener la accion solicitada a traves de parametros GET, POST...
    $action = BaseController::getUriSegments();

    switch ($action[1]) {
        case 'user':
            $userController = new UserController();
            $userController->method();
            break;
        case 'product':
            $productController = new ProductController();
            $productController->method();
            break;
        case 'productType':
            $productTypeController = new ProductTypeController();
            $productTypeController->method();
            break;
        case 'orders':
            $orderController = new OrderController();
            $orderController->method();
            break;
        case 'orderDetail':
            $orderDetailController = new OrderDetailController();
            $orderDetailController->method();
            break;
        case 'cart':
            $cartController = new CartController();
            $cartController->method();
            break;
        default:
            echo "Not a valid action";
            break;
    }
} else {
    echo "No action was specified";
}
?>
