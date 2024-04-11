<?php

require_once 'BaseController.php'; // Incluir la definición de la clase BaseController
require_once 'UserDAO.php'; // Incluir la definición de la clase UserDAO
require_once 'UserModel.php'; // Incluir la definición de la clase UserModel

class UserController extends BaseController
{
    private $userDAO;

    public function __construct(UserDAO $userDAO)
    {
        $this->userDAO = $userDAO;
    }

    public function createUser()
    {
        $data = $this->getUriSegments();
        // Obtener los datos necesarios para crear un nuevo usuario
        $username = isset($data[2]) ? $data[2] : null;
        $name = isset($data[3]) ? $data[3] : null;
        $rol = isset($data[4]) ? $data[4] : null;
        $password = isset($data[5]) ? $data[5] : null;
        $email = isset($data[6]) ? $data[6] : null;

        // Validar los datos si es necesario

        // Crear un nuevo objeto UserModel con los datos proporcionados
        $newUser = new UserModel($username, $name, $rol, $password, $email, true);

        // Llamar al método createUser en UserDAO para agregar el nuevo usuario a la base de datos
        try {
            $result = $this->userDAO->createUser($newUser);
            if ($result) {
                $this->sendOutput('User created successfully', array('HTTP/1.1 201 Created'));
            } else {
                $this->sendOutput('Failed to create user', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            $this->sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    // Otros métodos para manejar acciones relacionadas con usuarios
}
?>
