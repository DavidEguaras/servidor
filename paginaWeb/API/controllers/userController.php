<?php
require_once 'model/dataAccessObject/userDao.php'; // Incluir la definición de la clase UserDAO
require_once 'model/objectModels/userModel.php'; // Incluir la definición de la clase UserModel

class UserController extends BaseController
{
    private static $userDAO;

    public static function method()
    {
        // SWITCH METHOD
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        switch ($requestMethod) {
            case 'GET':
                $resources = self::getUriSegments();
                $filters = self::getQueryStringParams();

                if (count($resources) == 2 && count($filters) == 0) {
                    self::getAllUsers();
                } elseif (count($resources) == 3 && count($filters) == 0) {
                    self::getUserById($resources[2]);
                }else {
                    self::sendOutput('Invalid endpoint or parameters', array('HTTP/1.1 404 Not Found'));
                }
                break;

            case 'POST':
                self::createUser();
                break;

            case 'PUT':
                break;

            case 'DELETE':
                break;

            default:
                self::sendOutput('Invalid request method', array('HTTP/1.1 405 Method Not Allowed'));
                break;
        }
    }

    public static function createUser()
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);
        
        // Obtener los datos necesarios para crear un nuevo usuario
        $username = isset($data['username']) ? $data['username'] : null;
        $name = isset($data['name']) ? $data['name'] : null;
        $rol = isset($data['rol']) ? $data['rol'] : null;
        $password = isset($data['password']) ? $data['password'] : null;
        $email = isset($data['email']) ? $data['email'] : null;

        // Crear un nuevo objeto UserModel con los datos proporcionados
        $newUser = new UserModel($username, $name, $rol, $password, $email, true);

        // Llamar al método createUser en UserDAO para agregar el nuevo usuario a la base de datos
        try {
            $result = self::$userDAO->createUser($newUser);
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
            $users = self::$userDAO->getAllUsers();
            self::sendOutput(json_encode($users), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public static function getUserById($userId)
    {
        try {
            $user = self::$userDAO->getUserById($userId);
            self::sendOutput(json_encode($user), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public static function loginUser()
    {
        $data = self::getUriSegments();
        // Obtener los datos necesarios para iniciar sesión
        $username = isset($data[2]) ? $data[2] : null;
        $password = isset($data[3]) ? $data[3] : null;

        try {
            $user = self::$userDAO->login($username, $password);
            
            if ($user && $user->isActive()) {
                self::sendOutput('Login exitoso', array('HTTP/1.1 200 OK'));
            } else {
                self::sendOutput('Nombre de usuario o contraseña inválidos', array('HTTP/1.1 401 Unauthorized'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public static function logout()
    {
        // Lógica para cerrar sesión del usuario
        // Esto puede incluir la eliminación de cookies o datos de sesión
    }

    public static function changePassword($userId, $newPassword)
    {
        try {
            $result = self::$userDAO->changePassword($userId, $newPassword);
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
            $result = self::$userDAO->resetPassword($userId, $newPassword);
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
            $result = self::$userDAO->deleteUserAccount($userId, $active);
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
