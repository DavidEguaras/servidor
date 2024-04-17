<?php





class UserDAO extends Factory
{

    private function buildUserModel($userData)
    {
        //ver como se tratan los datos, uno o varios
        if ($userData) {
            // Crear un objeto UserModel con los datos del resultado
            return new UserModel(
                $userData['userID'],
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

    
    public function createUser(UserModel $user)
    {
        // Consulta SQL para insertar un nuevo usuario
        $query = "INSERT INTO USER (userID, username, name, rol, password, email, activo) VALUES (?, ?, ?, ?, ?, ?)";
        // Parámetros de la consulta
        $params = array(
            $userID->userID,
            $user->userName,
            $user->name,
            $user->rol,
            $user->password,
            $user->email,
            $user->activo
        );
        
        try {
            // Ejecutar la consulta
            $this->select($query, $params);
            return $user; // Devolver el objeto UserModel creado
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
            // Ejecutar la consulta y devolver el resultado
            $result = $this->select($query, $params);
            // Construir un objeto UserModel con los datos del resultado
            return $this->buildUserModel($result);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getUserById($userId)
    {
        // Consulta SQL
        $query = "SELECT * FROM USER WHERE USER_ID = ?";
        // Parámetros de la consulta
        $params = array($userId);
        
        try {
            // Ejecutar la consulta y devolver el resultado
            $result = $this->select($query, $params);
            // Construir un objeto UserModel con los datos del resultado
            return $this->buildUserModel($result);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function validateUser($username, $password)
    //TAMBIEN HAY QUE TENER EN CUENTA SI ESTA ACTIVO O NO
    {
        // Consulta SQL para buscar un usuario con el nombre de usuario y contraseña proporcionados
        $query = "SELECT * FROM USER WHERE username = ? AND password = ?";
        // Parámetros de la consulta
        $params = array($username, $password);

        try {
            // Ejecutar la consulta y devolver el resultado
            $result = $this->select($query, $params);
            // Construir un objeto UserModel con los datos del resultado
            return $this->buildUserModel($result);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}

?>
