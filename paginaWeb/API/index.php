<?php

// Incluir los archivos de configuración
require_once 'config/configBD.php';
require_once 'config/config.php';
require_once 'controllers/userController.php';
require_once 'controllers/productController.php';
require_once 'controllers/productTypeController.php';
require_once 'controllers/ordersController.php';
require_once 'controllers/orderDetailController.php';
require_once 'controllers/cartController.php';
require_once 'controllers/baseController.php';



// Obtener la acción solicitada, generalmente a través de parámetros GET o POST
$accion = BaseController::getUriSegments();

// Verificar accion
if (isset($accion[1])) {
    switch ($accion[1]) {
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
        case 'order':
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
            // Acción no válida
            echo "Acción no válida";
            break;
    }
} else {
    echo "No se especificó ninguna acción";
}


?>