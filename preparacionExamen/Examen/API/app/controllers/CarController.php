<?php
require_once 'app/models/Car.php';
require_once 'app/middlewares/AuthMiddleware.php';

class CarController {
    private $db;
    private $car;
    private $auth;

    public function __construct($db) {
        $this->db = $db;
        $this->car = new Car($db);
        $this->auth = new AuthMiddleware($db);
    }

    public function getCars() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if ($this->auth->validateToken()) {
                $filters = [
                    'model' => isset($_GET['model']) ? "%" . $_GET['model'] . "%" : '',
                    'brand' => isset($_GET['brand']) ? "%" . $_GET['brand'] . "%" : '',
                    'description' => isset($_GET['description']) ? "%" . $_GET['description'] . "%" : '',
                ];

                $stmt = $this->car->getCars($filters);
                $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

                http_response_code(200);
                echo json_encode($cars);
            }
        }
    }
}
?>
