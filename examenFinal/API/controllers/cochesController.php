<?php

require_once 'model/dataAccessObject/cochesDAO.php';
require_once 'model/objectModels/cochesModel.php';
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
                self::sendOutput('Invalid request method', array('HTTP/1.1 405 Method Not Allowed'));
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
        } elseif (count($resources) == 2 && (isset($filters['marca']) || isset($filters['modelo']) || isset($filters['descripcion']))) {
            self::getCochesByFilter($filters);
        } else {
            self::sendOutput('Invalid endpoint or parameters', array('HTTP/1.1 404 Not Found'));
        }
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
}

?>
