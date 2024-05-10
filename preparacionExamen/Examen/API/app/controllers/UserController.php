<?php
require_once 'app/models/User.php';

class UserController {
    private $db;
    private $user;

    public function __construct($db) {
        $this->db = $db;
        $this->user = new User($db);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"));

            $this->user->username = $data->username;
            $this->user->password = $data->password;

            $stmt = $this->user.validateUser();
            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                $token = bin2hex(random_bytes(16));
                $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

                $query = "UPDATE users SET token=:token, token_expiry=:token_expiry WHERE id=:id";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(":token", $token);
                $stmt->bindParam(":token_expiry", $expiry);
                $stmt->bindParam(":id", $user['id']);
                if ($stmt->execute()) {
                    http_response_code(200);
                    echo json_encode(["token" => $token]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Unable to update token."]);
                }
            } else {
                http_response_code(401);
                echo json_encode(["message" => "Invalid username or password."]);
            }
        }
    }

    public function createUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"));

            $this->user->username = $data->username;
            $this->user->password = $data->password;

            if ($this->user->createUser()) {
                http_response_code(201);
                echo json_encode(["message" => "User was created."]);
            } else {
                http_response_code(500);
                echo json_encode(["message" => "Unable to create user."]);
            }
        }
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
