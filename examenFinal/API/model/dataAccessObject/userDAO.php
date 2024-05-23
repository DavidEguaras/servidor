<?php

require_once './model/factory.php';
require_once './model/objectModels/userModel.php';

class UserDAO extends Factory
{
    public static function buildUserModel($userData) {
        if ($userData) {
            return array(
                'id' => $userData['id'],
                'user' => $userData['user'],
                'token' => $userData['token'],
                'caduca' => $userData['caduca']
            );
        } else {
            return null;
        }
    }

    public static function createUser(UserModel $user)
    {
        $query = "INSERT INTO Usuarios (user, token, caduca) VALUES (?, ?, ?)";
        $params = array($user->user, $user->token, $user->caduca);
        
        try {
            self::execute($query, $params);
            return true;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getAllUsers()
    {
        $query = "SELECT * FROM Usuarios";
        
        try {
            $result = self::select($query);
            $users = array();
            foreach ($result as $userData) {
                $users[] = self::buildUserModel($userData);
            }
            return $users;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function login($username, $password)
    {
        $query = "SELECT * FROM Usuarios WHERE user = ? AND token = ?";
        $params = array($username, $password);
        
        try {
            $result = self::select($query, $params);
            if (count($result) > 0) {
                return self::buildUserModel($result[0]);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}

?>
