<?php
require_once 'model/dataAccessObject/productTypeDao.php';
require_once 'model/objectModels/productTypeModel.php';
require_once 'paramValidators/paramValidator.php';


class ProductTypeController extends BaseController
{
    public static function method()
    {
        // Obtener el Metodo de la solicitud
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // Realizar la accion correspondiente segun el Metodo de solicitud
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
            case 'PATCH':
                self::handlePatchRequest();
                break;
            case 'DELETE':
                self::handleDeleteRequest();
                break;
            default:
                self::sendOutput('Invalid request method', array('HTTP/1.1 405 Method Not Allowed'));
                break;
        }
    }

    //---------------------------------------------REQUEST HANDLERS---------------------------------------------
    private static function handleGetRequest()
    {
        // Obtener los segmentos de la URI y los parametros de la cadena de consulta
        $resources = self::getUriSegments();
        $filters = self::getQueryStringParams();

        // Realizar acciones segun los recursos y los filtros
        if (count($resources) == 2 && count($filters) == 0) {
            self::getFirstProductForEachType();
        } elseif (count($resources) == 3 && count($filters) == 0) {
            self::getProductTypeByID($resources[2]);
        } elseif (count($resources) == 3 && $resources[2] == 'category' && isset($filters['name'])) {
            self::getProductTypesByCategory($filters['name']);
        } elseif (count($resources) == 3 && $resources[2] == 'brand' && isset($filters['name'])) {
            self::getProductTypesByBrand($filters['name']);
        } else {
            self::sendOutput('Invalid endpoint or parameters', array('HTTP/1.1 404 Not Found'));
        }
    }



    private static function handlePostRequest()
    {
        self::createProductType();
    }

    private static function handlePutRequest()
    {
       
    }

    private static function handlePatchRequest()
    {
        
    }

    private static function handleDeleteRequest()
    {
        
    }
    //---------------------------------------------REQUEST HANDLERS---------------------------------------------

    public static function getFirstProductForEachType()
    {
        try {
            // Obtener el primer producto (el último agregado) para cada tipo de producto
            $firstProducts = ProductTypeDAO::getFirstProductForEachType();
            self::sendOutput(json_encode($firstProducts), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public static function createProductType()
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);

        // Validar los datos recibidos
        $requiredParams = ['category', 'name', 'price', 'brand', 'description'];
        $error = '';

        if (!ParamValidator::validateParams($data, $requiredParams, $error)) {
            self::sendOutput('Missing required parameter: ' . $error, array('HTTP/1.1 400 Bad Request'));
            return;
        }

        if (!ParamValidator::validatePrice($data['price'])) {
            self::sendOutput('Invalid price format', array('HTTP/1.1 400 Bad Request'));
            return;
        }

        // Crear un nuevo objeto ProductTypeModel
        $productType = new ProductTypeModel(
            null,
            $data['category'],
            $data['name'],
            $data['price'],
            $data['brand'],
            $data['description']
        );

        try {
            // Insertar el nuevo tipo de producto en la base de datos
            $result = ProductTypeDAO::createProductType($productType);
            if ($result) {
                self::sendOutput('Product type created successfully', array('HTTP/1.1 201 Created'));
            } else {
                self::sendOutput('Failed to create product type', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public static function getAllProductTypes()
    {
        try {
            // Obtener todos los tipos de productos de la base de datos
            $productTypes = ProductTypeDAO::getAllProductTypes();
            self::sendOutput(json_encode($productTypes), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public static function getProductTypeByID($PT_ID)
    {
        try {
            // Obtener un tipo de producto por su ID de la base de datos
            $productType = ProductTypeDAO::getProductTypeByID($PT_ID);
            self::sendOutput(json_encode($productType), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public static function getFilteredProducts($filterArray){
        
    }
}
?>
