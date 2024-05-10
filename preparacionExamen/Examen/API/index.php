<?php
$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/cars':
        require 'app/routes/carRoutes.php';
        break;
    case '/login':
    case '/users':
        require 'app/routes/userRoutes.php';
        break;
    default:
        http_response_code(404);
        echo json_encode(["message" => "Not Found"]);
        break;
}
?>
