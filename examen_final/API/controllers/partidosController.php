<?php

require_once 'model/dataAccessObject/PartidosDAO.php';
require_once 'model/objectModels/PartidosModel.php';
require_once 'paramValidators/paramValidator.php';


class PartidosController extends BaseController
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
            case 'PUT':
                self::handlePutRequest();
                break;
            case 'DELETE':
                self::handleDeleteRequest();
                break;   
            default:
                self::sendOutput('Invalid request method', array('HTTP/1.1 405 Method Not Allowed'));
                break;
        }
    }


    //================================================HANDLERS================================================
    private static function handleGetRequest()
    {
        $resources = self::getUriSegments();
        $filters = self::getQueryStringParams();

        if (count($resources) == 2 && count($filters) == 0) 
        {
            self::getAllPartidos();
        }else if(count($resources) == 2) 
        {
            self::getPartidoByID($filters);
        }else if(count($resources) == 2  && isset($filters['jug1']) || isset($filters['jug2']))
        {
            self::getPartidoByUserID($filters);
        }
    }
    private static function handlePostRequest()
    {
        self::createPartido();
    }
    private static function handlePutRequest()
    {
        self::updatePartido();
    }
    private static function handleDeleteRequest()
    {
        $resources = self::getUriSegments();
        $filters = self::getQueryStringParams();

        if (count($resources) == 2 && isset($filters[1])) 
        {
            self::deletePartido($filters[1]);
        }
    }
    //================================================HANDLERS//================================================

    //-----GET
    public static function getAllPartidos()
    {
        try
        {
            $partidos = PartidosDao::getAllPartidos();
            self::sendOutput(json_encode($partidos), array('HTTP/1.1 200 OK'));
        }catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public static function getPartidoByID($filters)
    {
        try {
            $partido = PartidosDAO::getPartidoByID($filters);
            self::sendOutput(json_encode($partido), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public static function getPartidoByUserID($filters)
    {
        try {
            $partido = PartidosDAO::getPartidoByUserID($filters);
            self::sendOutput(json_encode($partido), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    //-----POST
    public static function createPartido()
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);

        $error = "";
        $requiredParams = ['jug1', 'jug2', 'fecha', 'resultado'];

        if (!ParamValidator::validateParams($data, $requiredParams, $error)) {
            self::sendOutput('Missing required parameters "' . $error . '"', array('HTTP/1.1 400 Bad Request'));
            return;
        }

        $jug1 = $data['jug1'];
        $jug2 = $data['jug2'];
        $fecha = $data['fecha'];
        $resultado = $data['resultado'];

        $nuevoPartido = new PartidosModel(null, $jug1, $jug2, $fecha, $resultado);

        try {
            $result = PartidosDAO::createPartido($nuevoPartido);
            if ($result) {
                self::sendOutput('Partido created successfully', array('HTTP/1.1 201 Created'));
            } else {
                self::sendOutput('Failed to create partido', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    //-----PUT

    public static function updatePartido()
    {

        $data = file_get_contents('php://input');
        $data = json_decode($data, true);

        $requiredParams = ['id', 'jug1', 'jug2', 'fecha', 'resultado'];
        if (!ParamValidator::validateParams($data, $requiredParams, $error)) {
            self::sendOutput('Missing required parameters', array('HTTP/1.1 400 Bad Request'));
            return;
        }

        try {
            $result = PartidosDAO::updatePartido(
                $data['id'],
                $data['jug1'],
                $data['jug2'],
                $data['fecha'],
                $data['resultado']
            );
            if ($result) {
                self::sendOutput('Partido updated successfully', array('HTTP/1.1 202 OK'));
            } else {
                self::sendOutput('Failed to update partido', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    //-----DELETE
    public static function deletePartido($partido_id)
    {
        try {
            $result = PartidosDAO::deletePartido($partido_id);
            if ($result) {
                self::sendOutput('Partido deleted successfully', array('HTTP/1.1 200 OK'));
            } else {
                self::sendOutput('Failed to delete Partido', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }
}