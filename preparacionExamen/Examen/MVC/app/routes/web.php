<?php
require_once 'app/controllers/UserController.php';
require_once 'app/controllers/CarController.php';

$userController = new UserController();
$carController = new CarController();

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if ($request == '/login' && $method == 'GET') {
    $userController->showLoginForm();
} elseif ($request == '/login' && $method == 'POST') {
    $userController->login();
} elseif ($request == '/register' && $method == 'GET') {
    $userController->showRegisterForm();
} elseif ($request == '/register' && $method == 'POST') {
    $userController->register();
} elseif ($request == '/logout' && $method == 'GET') {
    $userController->logout();
} elseif ($request == '/cars' && ($method == 'GET' || $method == 'POST')) {
    $carController->showCars();
} else {
    http_response_code(404);
    echo "Page not found";
}
?>
