<?php

// Incluir los archivos de configuración
require_once './config/configBD.php';
require_once './config/config.php';

// Verificar acción
if (isset($_SERVER['PATH_INFO'])) {
    // Obtener la acción solicitada a través de parámetros GET, POST...
    $action = BaseController::getUriSegments();

    switch ($action[1]) {
        case 'user':
            UserController::method();
            break;
        case 'coches':
            CochesController::method();
            break;
        default:
            echo "Not a valid action";
            break;
    }
} else {
    echo "No action was specified";
}

?>
