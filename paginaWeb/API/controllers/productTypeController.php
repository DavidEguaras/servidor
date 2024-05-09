<?php
require_once 'model/dataAccessObject/productTypeDAO.php'; // Incluir la definición de la clase ProductTypeDAO
require_once 'model/objectModels/productTypeModel.php'; // Incluir la definición de la clase ProductTypeModel

class ProductTypeController extends BaseController
{
    private static $productTypeDAO;


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
        // Obtener los segmentos de la URI y los parámetros de la cadena de consulta
        $resources = self::getUriSegments();
        $filters = self::getQueryStringParams();

        // Realizar acciones según los recursos y los filtros
        if (count($resources) == 2 && count($filters) == 0) {
            self::getAllProductTypes();
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
        // Implementa la lógica para manejar las solicitudes PUT
    }

    private static function handlePatchRequest()
    {
        // Implementa la lógica para manejar las solicitudes PATCH
    }

    private static function handleDeleteRequest()
    {
        // Implementa la lógica para manejar las solicitudes DELETE
    }
    //---------------------------------------------REQUEST HANDLERS---------------------------------------------


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
            $data['category'],
            $data['name'],
            $data['price'],
            $data['brand'],
            $data['description']
        );

        try {
            // Insertar el nuevo tipo de producto en la base de datos
            $result = self::$productTypeDAO->createProductType($productType);
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
            $productTypes = self::$productTypeDAO->getAllProductTypes();
            self::sendOutput(json_encode($productTypes), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public static function getProductTypeByID($ptID)
    {
        try {
            // Obtener un tipo de producto por su ID de la base de datos
            $productType = self::$productTypeDAO->getProductTypeByID($ptID);
            self::sendOutput(json_encode($productType), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public static function getProductTypesByCategory($category)
    {
        try {
            // Obtener tipos de productos por categoría de la base de datos
            $productTypes = self::$productTypeDAO->getProductTypesByCategory($category);
            self::sendOutput(json_encode($productTypes), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public static function getProductTypesByBrand($brand)
    {
        try {
            // Obtener tipos de productos por marca de la base de datos
            $productTypes = self::$productTypeDAO->getProductTypesByBrand($brand);
            self::sendOutput(json_encode($productTypes), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }
}
?>
