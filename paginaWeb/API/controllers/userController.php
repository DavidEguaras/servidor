<?php
require_once 'model/dataAccessObject/userDao.php'; // Incluir la definición de la clase UserDAO
require_once 'model/objectModels/userModel.php'; // Incluir la definición de la clase UserModel
require_once 'paramValidators/paramValidator.php'; // Incluir el validador de parámetros

class UserController extends BaseController
{
 

    public static function method()
    {
        // Obtener el método de la solicitud
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // Realizar la acción correspondiente según el método de solicitud
        switch ($requestMethod) {
            case 'GET':
                self::handleGetRequest();
                break;

            case 'POST':
                self::handlePostRequest();
                break;

            // case 'PUT':
            //     self::handlePutRequest();
            //     break;
            
            default:
                self::sendOutput('Invalid request method', array('HTTP/1.1 405 Method Not Allowed'));
                break;
        }
    }

    private static function handleGetRequest()
    {
        // Obtener los segmentos de la URI y los parámetros de la cadena de consulta
        $resources = self::getUriSegments();
        $filters = self::getQueryStringParams();
    
        // Realizar acciones según los recursos y los filtros
        if (count($resources) == 2 && count($filters) == 0) {
            self::getAllUsers();
        } elseif (count($resources) == 3 && count($filters) == 0) {
            self::getUserById($resources[2]);
        } else {
            self::sendOutput('Invalid endpoint or parameters', array('HTTP/1.1 404 Not Found'));
        }
    }
    
    private static function handlePostRequest()
    {
        self::createUser();
    }
    
    /*
    private static function handlePutRequest()
    {
        //Si agregamos un metodo put, implementamos aqui la logica
    }
    */

    public static function createUser()
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);
    
        $error = "";
        $requiredParams = ['username', 'name', 'rol', 'password', 'email'];
    
        if (!ParamValidator::validateParams($data, $requiredParams, $error)) {
            self::sendOutput('Missing required parameters "' . $error .'"', array('HTTP/1.1 400 Bad Request'));
            return;
        }
    
        if (!ParamValidator::validatePassword($data['password'])) {
            self::sendOutput('Password must contain at least one special character', array('HTTP/1.1 400 Bad Request'));
            return;
        }
    
        if (!ParamValidator::validateEmail($data['email'])) {
            self::sendOutput('Invalid email format', array('HTTP/1.1 400 Bad Request'));
            return;
        }
    
        if (!ParamValidator::validateName($data['name'])) {
            self::sendOutput('Name must not contain numbers', array('HTTP/1.1 400 Bad Request'));
            return;
        }
    
        if (!ParamValidator::validateRole($data['rol'])) {
            self::sendOutput('Invalid role', array('HTTP/1.1 400 Bad Request'));
            return;
        }
    
        $username = $data['username'];
        $name = $data['name'];
        $rol = $data['rol'];
        $password = sha1($data['password']);
        $email = $data['email'];
    
    
        $newUser = new UserModel(null, $username, $name, $rol, $password, $email, true);
     
        try {
            $result = UserDAO::createUser($newUser);
            if ($result) {
                self::sendOutput('User created successfully', array('HTTP/1.1 201 Created'));
            } else {
                self::sendOutput('Failed to create user', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }
    

    public static function getAllUsers()
    {
        try {
            $users = UserDAO::getAllUsers();
            self::sendOutput(json_encode($users), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public static function getUserById($userId)
    {
        try {
            $user = UserDAO::getUserById($userId);
            self::sendOutput(json_encode($user), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public static function loginUser()
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);

        // Validar los parámetros
        $requiredParams = ['username', 'password'];
        if (!ParamValidator::validateParams($data, $requiredParams)) {
            self::sendOutput('Missing required parameters', array('HTTP/1.1 400 Bad Request'));
            return;
        }

        $username = $data['username'];
        $password = $data['password'];

        try {
            $user = UserDAO::login($username, $password);

            if ($user && $user->isActive()) {
                self::sendOutput('Login exitoso', array('HTTP/1.1 200 OK'));
            } else {
                self::sendOutput('Nombre de usuario o contraseña inválidos', array('HTTP/1.1 401 Unauthorized'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }


    public static function changePassword($userId, $newPassword)
    {
        try {
            $result = UserDAO::changePassword($userId, $newPassword);
            if ($result) {
                self::sendOutput('Password changed successfully', array('HTTP/1.1 200 OK'));
            } else {
                self::sendOutput('Failed to change password', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public static function resetPassword($userId, $newPassword)
    {
        try {
            $result = UserDAO::resetPassword($userId, $newPassword);
            if ($result) {
                self::sendOutput('Password reset successfully', array('HTTP/1.1 200 OK'));
            } else {
                self::sendOutput('Failed to reset password', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public static function deleteUserAccount($userId, $active)
    {
        try {
            $result = UserDAO::deleteUserAccount($userId, $active);
            if ($result) {
                self::sendOutput('User account updated successfully', array('HTTP/1.1 200 OK'));
            } else {
                self::sendOutput('Failed to update user account', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }
}
?>
