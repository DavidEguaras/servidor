<?php

// Incluir los archivos de configuración
require_once './config/configBD.php';
require_once './config/config.php';


// Verificar acción
if (isset($_SERVER['PATH_INFO'])) {
    // Obtener la acción solicitada a través de parámetros GET, POST...
    $action = BaseController::getUriSegments();

    if (isset($action[1])) {
        switch ($action[1]) {
            case 'user':
                UserController::method();
                break;
            case 'coches':
                CocheController::method();
                break;
            default:
                BaseController::sendOutput("Not a valid action", array('HTTP/1.1 400 Bad Request'));
                break;
        }
    } else {
        BaseController::sendOutput("No action was specified", array('HTTP/1.1 400 Bad Request'));
    }
} else {
    BaseController::sendOutput("No action was specified", array('HTTP/1.1 400 Bad Request'));
}
?>