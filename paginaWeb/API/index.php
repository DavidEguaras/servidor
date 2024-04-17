<?php

// Incluir los archivos de configuración
require_once 'config/configBD.php';
require_once 'config/config.php';
require_once 'controllers/UserController.php';
require_once 'controllers/ProductController.php';
require_once 'controllers/ProductTypeController.php';
require_once 'controllers/OrderController.php';
require_once 'controllers/OrderDetailController.php';
require_once 'controllers/CartController.php';



// Obtener la acción solicitada, generalmente a través de parámetros GET o POST
$accion = isset($_GET['action']) ? $_GET['action'] : null;

// Dependiendo de la acción solicitada, dirigir la solicitud al controlador correspondiente
switch ($accion) {
    case 'user':
        $userController = new UserController();
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