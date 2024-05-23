<?php

require_once './model/factory.php';
require_once './model/objectModels/userModel.php';

class UserDAO extends Factory
{
    public static function getAllUsers()
    {
        $query = "SELECT * FROM usuarios";
        try {
            $result = self::select($query);
            return $result;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getUserByUsername($username)
    {
        $query = "SELECT * FROM usuarios WHERE username = ?";
        $params = [$username];
        try {
            $result = self::select($query, $params);
            return $result ? $result[0] : null;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function createUser(UserModel $user)
    {
        $query = "INSERT INTO usuarios (username, name, rol, password, email) VALUES (?, ?, ?, ?, ?)";
        $params = [
            $user->username,
            $user->name,
            $user->rol,
            $user->password,
            $user->email
        ];

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
        $params = [$username, $password];
        try {
            $result = self::select($query, $params);
            return $result ? $result[0] : null;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}
?>
