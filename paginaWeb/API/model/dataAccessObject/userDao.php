<?php
class UserDAO extends Factory
{

    public static function buildUserModel($userData)
    {
        if ($userData) {
            return array(
                'USER_ID' =>$userData['USER_ID'],
                'username' =>$userData['username'],
                'name' =>$userData['name'],
                'rol' =>$userData['rol'],
                'password' =>$userData['password'],
                'email' =>$userData['email'],
                'active' =>$userData['active']
            );
        } else {
            return null;
        }
    }

    
    public static function createUser($user)
    {
        $query = "INSERT INTO USER VALUES (NULL,?, ?, ?, ?, ?, ?)";
        $params = array(
            $user->userName,
            $user->name,
            $user->rol,
            $user->password,
            $user->email,
            $user->active
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


    public static function getUserById($USER_ID)
    {
        $query = "SELECT * FROM USER WHERE USER_ID = ?";
        $params = array($USER_ID);
        
        try {
            $result = self::select($query, $params);
            return self::buildUserModel($result);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    

    public static function login($username, $password)
    {
    
        // Mensajes de depuración
        error_log("Intentando iniciar sesión con:");
        error_log("Username: " . $username);
        error_log("Password: " . $password);
    
        $query = "SELECT * FROM USER WHERE username = ? AND password = ? AND active = 1";
        $params = array($username, $password);
    
        try {
            $result = self::select($query, $params);
            if (!empty($result) && count($result) == 1) {
                return self::buildUserModel($result[0]);
            } else {
                return null; // Devolvemos null si no hay coincidencia
            }
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    
    


    public static function deleteUserAccount($USER_ID)
    {
        $query = "UPDATE USER SET active = 0 WHERE USER_ID = ?";
        $params = array($active, $USER_ID);
        
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
