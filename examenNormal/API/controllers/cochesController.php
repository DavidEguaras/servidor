<?php

require_once 'model/dataAccessObject/cochesDAO.php';
require_once 'model/objectModels/cochesModel.php';
require_once 'paramValidators/paramValidator.php';


class CocheController extends BaseController
{
    public static function method()
    {
        if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
            self::sendOutput('No credentials provided', array('HTTP/1.1 401 Unauthorized'));
        }

        $username = $_SERVER['PHP_AUTH_USER'];
        $password = $_SERVER['PHP_AUTH_PW'];

        if (!self::validatePassword($username, $password)) {
            self::sendOutput('Invalid credentials', array('HTTP/1.1 401 Unauthorized'));
        }

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
            self::getAllCoches();
        } elseif (count($resources) == 2 && (isset($filters['modelo']) || isset($filters['marca']) || isset($filters['descripcion']))) {
            self::getCochesByFilter($filters);
        } else {
            self::sendOutput('Invalid endpoint or parameters', array('HTTP/1.1 404 Not Found'));
        }
    }

    private static function handlePostRequest()
    {
        self::createCoche();
    }

    public static function getAllCoches()
    {
        try {
            $coches = CocheDAO::getAllCoches();
            self::sendOutput(json_encode($coches), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public static function getCochesByFilter($filters)
    {
        try {
            $coches = CocheDAO::getCochesByFilter($filters);
            self::sendOutput(json_encode($coches), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public static function createCoche()
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);

        $error = "";
        $requiredParams = ['modelo', 'marca', 'descripcion', 'precio'];

        if (!ParamValidator::validateParams($data, $requiredParams, $error)) {
            self::sendOutput('Missing required parameters "' . $error . '"', array('HTTP/1.1 400 Bad Request'));
            return;
        }

        $modelo = $data['modelo'];
        $marca = $data['marca'];
        $descripcion = $data['descripcion'];
        $precio = $data['precio'];

        $newCoche = new CocheModel(null, $modelo, $marca, $descripcion, $precio);

        try {
            $result = CocheDAO::createCoche($newCoche);
            if ($result) {
                self::sendOutput('Coche created successfully', array('HTTP/1.1 201 Created'));
            } else {
                self::sendOutput('Failed to create coche', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }
}
?>