<?php
require_once 'config/database.php';
require_once 'app/controllers/UserController.php';

$database = new Database();
$db = $database->getConnection();

$userController = new UserController($db);

if ($_SERVER['REQUEST_URI'] == '/login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController->login();
} elseif ($_SERVER['REQUEST_URI'] == '/users' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController->createUser();
}
?>
