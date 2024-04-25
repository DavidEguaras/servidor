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


switch ($accion[1]) {
    case 'user':
        $userController = new UserController();
        $userController -> method();
        // Lógica para manejar las acciones relacionadas con usuarios
        break;
    case 'product':
        $productController = new ProductController();
        // Lógica para manejar las acciones relacionadas con productos
        break;
    case 'productType':
        $productTypeController = new ProductTypeController();
        // Lógica para manejar las acciones relacionadas con tipos de productos
        break;
    case 'order':
        $orderController = new OrderController();
        // Lógica para manejar las acciones relacionadas con pedidos
        break;
    case 'orderDetail':
        $orderDetailController = new OrderDetailController();
        // Lógica para manejar las acciones relacionadas con detalles de pedidos
        break;
    case 'cart':
        $cartController = new CartController();
        // Lógica para manejar las acciones relacionadas con el carrito de compras
        break;
    default:
        // Acción no válida
        echo "Acción no válida";
        break;
}