<?php

// Incluir los archivos de configuración
require_once 'Config/configBD.php';
require_once 'Config/config.php';

// Incluir los controladores y modelos necesarios
require_once 'Controllers/UserController.php';
require_once 'Controllers/ProductController.php';

// Obtener la acción solicitada, generalmente a través de parámetros GET o POST
$action = isset($_GET['action']) ? $_GET['action'] : 'index'; // Por ejemplo, acción index por defecto

// Dependiendo de la acción solicitada, dirigir la solicitud al controlador correspondiente
switch ($action) {
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
