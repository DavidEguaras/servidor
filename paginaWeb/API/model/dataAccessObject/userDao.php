<?php
require_once('../config/configBD.php');
require_once('../factory.php');

class UserDAO extends Factory
{
    public function createUser($username, $name, $rol, $password, $email)
    {
        // Consulta SQL para insertar un nuevo usuario.
        $query = "INSERT INTO USER (username, name, rol, password, email) VALUES (?, ?, ?, ?, ?)";
        // Parámetros de la consulta.
        $params = array($username, $name, $rol, $password, $email);
        
        try {
            // Ejecutar la consulta.
            $this->executeStatement($query, $params);
            return true; // Devolver true si la inserción es exitosa.
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getUserByUsername($username)
    {
        // Consulta SQL
        $query = "SELECT * FROM USER WHERE username = ?";
        // Parámetros de la consulta.
        $params = array($username);
        
        try {
            // Ejecutar la consulta y devolver el resultado.
            $result = $this->select($query, $params);
            return $result;
            
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getUserById($userId)
    {
        // Consulta SQL
        $query = "SELECT * FROM USER WHERE USER_ID = ?";
        // Parámetros de la consulta.
        $params = array($userId);
        
        try {
            // Ejecutar la consulta y devolver el resultado.
            $result = $this->select($query, $params);
            return $result;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}
?>
