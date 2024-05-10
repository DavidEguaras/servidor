<?php
require_once 'config/database.php';
require_once 'app/controllers/CarController.php';

$database = new Database();
$db = $database->getConnection();

$carController = new CarController($db);

if ($_SERVER['REQUEST_URI'] == '/cars' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $carController->getCars();
}
?>
