<?php
require_once 'model/dataAccessObject/productDao.php'; // Incluir la definición de la clase ProductDAO
require_once 'model/objectModels/productModel.php'; // Incluir la definición de la clase ProductModel
require_once 'paramValidators/paramValidator.php'; // Incluir el validador de parámetros

class ProductController extends BaseController
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

    // Handler para las solicitudes GET
    private static function handleGetRequest()
    {
        $resources = self::getUriSegments();
        $filters = self::getQueryStringParams();

        // Realizar acciones según los recursos y los filtros
        if (count($resources) == 1 && count($filters) == 0) {
            // Obtener todos los productos
            try {
                $products = ProductDAO::getAllProducts();
                self::sendOutput(json_encode($products), array('HTTP/1.1 200 OK'));
            } catch (Exception $e) {
                self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
            }
        } elseif (count($resources) == 2 && isset($resources[1]) && is_numeric($resources[1])) {
            // Obtener un producto por su ID
            try {
                $product = ProductDAO::getProductByID($resources[1]);
                self::sendOutput(json_encode($product), array('HTTP/1.1 200 OK'));
            } catch (Exception $e) {
                self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
            }
        } else {
            self::sendOutput('Invalid endpoint or parameters', array('HTTP/1.1 404 Not Found'));
        }
    }

    // Handler para las solicitudes POST
    private static function handlePostRequest()
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);

        // Validar los datos del producto
        $requiredParams = ['color', 'size', 'stock', 'imageRoute', 'productTypeID'];
        if (!ParamValidator::validateParams($data, $requiredParams)) {
            self::sendOutput('Missing required parameters', array('HTTP/1.1 400 Bad Request'));
            return;
        }

        // Crear un nuevo objeto ProductModel
        $newProduct = new ProductModel(
            null,
            $data['color'],
            $data['size'],
            $data['stock'],
            $data['imageRoute'],
            $data['productTypeID']
        );

        // Crear el producto en la base de datos
        try {
            $result = ProductDAO::createProduct($newProduct);
            if ($result) {
                self::sendOutput('Product created successfully', array('HTTP/1.1 201 Created'));
            } else {
                self::sendOutput('Failed to create product', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    // Handler para las solicitudes PUT
    private static function handlePutRequest()
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);

        // Validar los datos del producto
        $requiredParams = ['productID', 'color', 'size', 'stock', 'imageRoute'];
        if (!ParamValidator::validateParams($data, $requiredParams)) {
            self::sendOutput('Missing required parameters', array('HTTP/1.1 400 Bad Request'));
            return;
        }

        // Actualizar la información del producto en la base de datos
        try {
            $result = ProductDAO::updateProductInfo(
                $data['productID'],
                $data['color'],
                $data['size'],
                $data['stock'],
                $data['imageRoute']
            );
            if ($result) {
                self::sendOutput('Product updated successfully', array('HTTP/1.1 200 OK'));
            } else {
                self::sendOutput('Failed to update product', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    // Handler para las solicitudes DELETE
    private static function handleDeleteRequest()
    {
        $resources = self::getUriSegments();

        // Verificar si se proporcionó el ID del producto en la URL
        if (count($resources) == 2 && isset($resources[1]) && is_numeric($resources[1])) {
            // Eliminar el producto por su ID
            try {
                $result = ProductDAO::deleteProduct($resources[1]);
                if ($result) {
                    self::sendOutput('Product deleted successfully', array('HTTP/1.1 200 OK'));
                } else {
                    self::sendOutput('Failed to delete product', array('HTTP/1.1 500 Internal Server Error'));
                }
            } catch (Exception $e) {
                self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
            }
        } else {
            self::sendOutput('Invalid endpoint or parameters', array('HTTP/1.1 404 Not Found'));
        }
    }
}
?>
