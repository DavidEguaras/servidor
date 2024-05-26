<?php
require_once 'model/dataAccessObject/userDao.php';
require_once 'model/objectModels/userModel.php';
require_once 'paramValidators/paramValidator.php';

class UserController extends BaseController
{
    public static function method()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        switch ($requestMethod) {
            case 'GET':
                self::handleGetRequest();
                break;
            case 'POST':
                self::handlePostRequest();
                break;
            default:
                self::sendOutput('Invalid request method', array('HTTP/1.1 405 Method Not Allowed'));
                break;
        }
    }

    private static function handleGetRequest()
    {
        $resources = self::getUriSegments();
        $filters = self::getQueryStringParams();
    
        if (count($resources) == 2 && count($filters) == 0) {
            self::getAllUsers();
        } elseif (count($resources) == 2 && isset($filters['username']) && isset($filters['password'])) {
            self::loginUser($filters);
        } else {
            self::sendOutput('Invalid endpoint or parameters', array('HTTP/1.1 404 Not Found'));
        }
    }
    
  
    

    private static function handlePostRequest()
    {
        self::createUser();
    }


    public static function createUser()
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);

        $error = "";
        $requiredParams = ['username', 'name', 'rol', 'password', 'email'];

        if (!ParamValidator::validateParams($data, $requiredParams, $error)) {
            self::sendOutput('Missing required parameters "' . $error . '"', array('HTTP/1.1 400 Bad Request'));
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
        $password = $data['password'];
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

    public static function getUserById($USER_ID)
    {
        try {
            $user = UserDAO::getUserById($USER_ID);
            self::sendOutput(json_encode($user), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }


    public static function loginUser($data)
    {
        $requiredParams = ['username', 'password'];
        $error = "";
        if (!ParamValidator::validateParams($data, $requiredParams, $error)) {
            self::sendOutput('Missing required parameters "' . $error . '"', array('HTTP/1.1 400 Bad Request'));
            return;
        }
    
        $username = $data['username'];
        $password = $data['password'];
    
        try {
            $user = UserDAO::login($username, $password);
    
            if ($user) {
                self::sendOutput(json_encode($user), array('HTTP/1.1 200 OK'));
            } else {
                self::sendOutput('Nombre de usuario o contraseña inválidos', array('HTTP/1.1 401 Unauthorized'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }
    


    public static function deleteUserAccount($USER_ID, $active)
    {
        try {
            $result = UserDAO::deleteUserAccount($USER_ID, $active);
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