<?php

require_once './model/dataAccessObject/userDAO.php';
require_once './model/objectModels/userModel.php';
require_once './controllers/paramValidators/paramValidator.php';


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

    public static function getAllUsers()
    {
        try {
            $users = UserDAO::getAllUsers();
            self::sendOutput(json_encode($users), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
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

    public static function loginUser($data)
    {
        $requiredParams = ['username', 'password'];
        $error = "";
        if (!ParamValidator::validateParams($data, $requiredParams, $error)) {
            self::sendOutput('Missing required parameters "' . $error . '"', array('HTTP/1.1 400 Bad Request'));
            return;
        }

        $username = $data['username'];
        $password = sha1($data['password']);

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
}
?>