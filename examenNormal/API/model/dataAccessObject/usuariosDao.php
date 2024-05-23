<?php

require_once './model/factory.php';
require_once './model/objectModels/Usuario.php';


class UsuariosDAO extends Factory
{
    public static function buildUsuarioModel($usuarioData) {
        if ($usuarioData) {
            return array(
                'id' => $usuarioData['id'],
                'username' => $usuarioData['username'],
                'name' => $usuarioData['name'],
                'rol' => $usuarioData['rol'],
                'email' => $usuarioData['email']
            );
        } else {
            return null;
        }
    }

    public static function createUser(Usuario $usuario)
    {
        $query = "INSERT INTO usuarios (username, name, rol, password, email) VALUES (?, ?, ?, ?, ?)";
        $params = array(
            $usuario->username,
            $usuario->name,
            $usuario->rol,
            $usuario->password,
            $usuario->email
        );

        try {
            self::insert($query, $params);
            return true;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function login($username, $password)
    {
        $query = "SELECT * FROM usuarios WHERE username = ? AND password = ?";
        $params = array($username, $password);

        try {
            $result = self::select($query, $params);
            if (count($result) > 0) {
                return self::buildUsuarioModel($result[0]);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getAllUsers()
    {
        $query = "SELECT * FROM usuarios";
        try {
            $result = self::select($query);
            $users = [];
            foreach ($result as $userData) {
                $users[] = self::buildUsuarioModel($userData);
            }
            return $users;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}
?>
