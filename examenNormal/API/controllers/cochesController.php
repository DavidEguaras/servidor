<?php

require_once './model/dataAccessObject/cochesDao.php';
require_once './model/objectModels/Coche.php';
require_once 'paramValidators/paramValidator.php';

class CochesController extends BaseController
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

        // Para depuración
        error_log(print_r($resources, true));
        error_log(print_r($filters, true));

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
            $coches = CochesDAO::getAllCoches();
            self::sendOutput(json_encode($coches), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public static function getCochesByFilter($filters)
    {
        try {
            $coches = CochesDAO::getCochesByFilter($filters);
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

        $newCoche = new Coche(null, $modelo, $marca, $descripcion, $precio);

        try {
            $result = CochesDAO::createCoche($newCoche);
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
