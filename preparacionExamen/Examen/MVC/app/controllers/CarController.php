<?php
require_once 'app/models/Car.php';
require_once 'app/middlewares/AuthMiddleware.php';

class CarController {
    public function showCars() {
        session_start();
        if (!isset($_SESSION['token'])) {
            header('Location: /login');
            exit();
        }

        $token = $_SESSION['token'];
        $filters = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $filters['model'] = $_POST['model'] ?? '';
            $filters['brand'] = $_POST['brand'] ?? '';
            $filters['description'] = $_POST['description'] ?? '';
        }

        $cars = Car::getCars($token, $filters);
        require 'app/views/cars.php';
    }
}
?>
