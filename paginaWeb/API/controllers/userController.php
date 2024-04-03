
<?php
require_once('../models/UserDAO.php');

class UserController {
    protected $userDAO;

    // Constructor para inicializar el objeto UserDAO
    public function __construct() {
        $this->userDAO = new UserDAO();
    }

    public function createUser($username, $name, $rol, $password, $email) {
        try {
            // Llamar al método createUser del UserDAO para insertar el usuario
            $result = $this->userDAO->createUser($username, $name, $rol, $password, $email);
            return $result;
        } catch (Exception $e) {
            // Manejo de excepciones.
            return $e->getMessage();
        }
    }

  
    public function getUserByUsername($username) {
        try {
            // Llamar al método getUserByUsername del UserDAO para obtener el usuario
            $result = $this->userDAO->getUserByUsername($username);
            return $result;
        } catch (Exception $e) {
            // Manejo de excepciones
            return $e->getMessage();
        }
    }

    public function getUserById($userId) {
        try {
            // Llamar al método getUserById del UserDAO para obtener el usuario
            $result = $this->userDAO->getUserById($userId);
            return $result;
        } catch (Exception $e) {
            // Manejo de excepciones.
            return $e->getMessage();
        }
    }
}
?>
