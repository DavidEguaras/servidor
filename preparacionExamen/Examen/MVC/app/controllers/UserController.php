<?php
require_once 'app/models/User.php';

class UserController {
    public function showLoginForm() {
        require 'app/views/login.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $response = User::login($username, $password);

            if ($response && isset($response->token)) {
                session_start();
                $_SESSION['token'] = $response->token;
                header('Location: /cars');
                exit();
            } else {
                $error = "Invalid credentials";
                require 'app/views/login.php';
            }
        }
    }

    public function showRegisterForm() {
        require 'app/views/register.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $response = User::register($username, $password);

            if ($response && isset($response->message)) {
                $token = bin2hex(random_bytes(16));
                $expiry = date('Y-m-d H:i:s', strtotime('+10 days'));
                require 'app/views/token.php';
            } else {
                $error = "Unable to register";
                require 'app/views/register.php';
            }
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /login');
        exit();
    }
}
?>
