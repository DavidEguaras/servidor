<?php

// Incluir los archivos de configuración
require_once 'config/configBD.php';
require_once 'config/config.php';



// Obtener la acción solicitada, generalmente a través de parámetros GET o POST

$accion = BaseController::getUriSegments();


// Dependiendo de la acción solicitada, dirigir la solicitud al controlador correspondiente
switch ($accion[1]) {
    case 'user':
        $userController = new UserController();
        // Lógica para manejar las acciones relacionadas con usuarios
        break;
    case 'product':
        $productController = new ProductController();
        // Lógica para manejar las acciones relacionadas con productos
        break;
    case 'order':
        $orderController = new OrderController();
        // Lógica para manejar las acciones relacionadas con pedidos
        break;
}
