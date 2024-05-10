<?php
require_once 'app/models/User.php';

class AuthMiddleware {
    private $db;
    private $user;

    public function __construct($db) {
        $this->db = $db;
        $this->user = new User($db);
    }

    public function validateToken() {
        $headers = getallheaders();
        $token = isset($headers['Authorization']) ? $headers['Authorization'] : '';

        $this->user->token = $token;
        $stmt = $this->user->getUserByToken();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            http_response_code(405);
            echo json_encode(["message" => "Token expired or invalid."]);
            return false;
        }
    }
}
?>
