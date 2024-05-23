
<?php

// Incluir los archivos de configuración
require_once './config/configBD.php';
require_once './config/config.php';

if (isset($_SERVER['PATH_INFO'])) {
    $action = BaseController::getUriSegments();

    // Para depuración
    error_log(print_r($action, true));

    if (isset($action[1])) {
        switch ($action[1]) {
            case 'usuarios':
                UsuariosController::method();
                break;
            case 'coches':
                CochesController::method();
                break;
            default:
                echo json_encode(['error' => 'Invalid action']);
                http_response_code(404);
                break;
        }
    } else {
        echo json_encode(['error' => 'Invalid action']);
        http_response_code(404);
    }
} else {
    echo json_encode(['error' => 'No action specified']);
    http_response_code(400);
}
?>
