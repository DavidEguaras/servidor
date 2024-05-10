<?php
require_once '../config.php';
require_once '../app/routes/web.php';

// Iniciar sesión
session_start();

// Obtener la solicitud y el método HTTP
$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// Eliminar parámetros de consulta de la solicitud
$request = strtok($request, '?');

// Ruta de login
if ($request == '/login' && $method == 'GET') {
    $userController = new UserController();
    $userController->showLoginForm();
} elseif ($request == '/login' && $method == 'POST') {
    $userController = new UserController();
    $userController->login();
}

// Ruta de registro
elseif ($request == '/register' && $method == 'GET') {
    $userController = new UserController();
    $userController->showRegisterForm();
} elseif ($request == '/register' && $method == 'POST') {
    $userController = new UserController();
    $userController->register();
}

// Ruta de logout
elseif ($request == '/logout' && $method == 'GET') {
    $userController = new UserController();
    $userController->logout();
}

// Ruta de coches
elseif ($request == '/cars' && ($method == 'GET' || $method == 'POST')) {
    $carController = new CarController();
    $carController->showCars();
}

// Ruta no encontrada
else {
    http_response_code(404);
    echo "Page not found";
}
?>
