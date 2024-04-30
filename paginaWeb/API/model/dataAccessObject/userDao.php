<?php
class UserDAO extends Factory
{

    public static function buildUserModel($userData)
    {
        if ($userData) {
            return new UserModel(
                $userData['username'],
                $userData['name'],
                $userData['rol'],
                $userData['password'],
                $userData['email'],
                $userData['activo']
            );
        } else {
            return null;
        }
    }

    
    public static function createUser($user)
    {
        $query = "INSERT INTO USER (username, name, rol, password, email, activo) VALUES (?, ?, ?, ?, ?, ?)";
        $params = array(
            $user->userName,
            $user->name,
            $user->rol,
            $user->password,
            $user->email,
            $user->activo
        );
        
        try {
            self::select($query, $params);
            return $user;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getUserByUsername($username)
    {
        $query = "SELECT * FROM USER WHERE username = ?";
        $params = array($username);
        
        try {
            $result = self::select($query, $params);
            return self::buildUserModel($result);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    public static function getAllUsers()
    {
        $query = "SELECT * FROM USER";
        
        try {
            $result = self::selectAll($query);
            
            $users = array();
            foreach ($result as $userData) {
                $users[] = self::buildUserModel($userData);
            }
            return $users;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }


    public static function getUserById($userId)
    {
        $query = "SELECT * FROM USER WHERE USER_ID = ?";
        $params = array($userId);
        
        try {
            $result = self::select($query, $params);
            return self::buildUserModel($result);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function login($username, $password)
    {
        $query = "SELECT * FROM USER WHERE username = ? AND password = ? AND activo = 1";
        $params = array($username, $password);

        try {
            $result = self::select($query, $params);
            return self::buildUserModel($result);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    public static function changePassword($userId, $newPassword)
    {
        $query = "UPDATE USER SET password = ? WHERE USER_ID = ?";
        $params = array($newPassword, $userId);
        
        try {
            self::select($query, $params);
            // Devuelve true si la contraseña se cambió correctamente
            return true;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function deleteUserAccount($userId, $active)
    {
        $query = "UPDATE USER SET activo = ? WHERE USER_ID = ?";
        $params = array($active, $userId);
        
        try {
            self::select($query, $params);
            // Devuelve true si la cuenta de usuario se activó o desactivó correctamente
            return true;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}



?>
