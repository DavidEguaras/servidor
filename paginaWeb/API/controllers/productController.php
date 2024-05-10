<?php
require_once 'model/dataAccessObject/productDao.php'; 
require_once 'model/objectModels/productModel.php'; 
require_once 'paramValidators/paramValidator.php';

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

    //---------------------------------------------REQUEST HANDLERS---------------------------------------------
    // Handler para las solicitudes GET
    private static function handleGetRequest()
    {
        $resources = self::getUriSegments();
        $filters = self::getQueryStringParams();

        if (count($resources) == 1 && count($filters) == 0) {
            self::getAllProducts();
        } elseif (count($resources) == 2 && isset($resources[1]) && is_numeric($resources[1])) {
            self::getProductById($resources[1]);
        } else {
            self::sendOutput('Invalid endpoint or parameters', array('HTTP/1.1 404 Not Found'));
        }
    }

    // Handler para las solicitudes POST
    private static function handlePostRequest()
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);

        $requiredParams = ['color', 'size', 'stock', 'imageRoute', 'productTypeID'];
        if (!ParamValidator::validateParams($data, $requiredParams)) {
            self::sendOutput('Missing required parameters', array('HTTP/1.1 400 Bad Request'));
            return;
        }

        self::createProduct($data);
    }

    // Handler para las solicitudes PUT
    private static function handlePutRequest()
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);

        $requiredParams = ['productID', 'color', 'size', 'stock', 'imageRoute'];
        if (!ParamValidator::validateParams($data, $requiredParams)) {
            self::sendOutput('Missing required parameters', array('HTTP/1.1 400 Bad Request'));
            return;
        }

        self::updateProduct($data);
    }

    // Handler para las solicitudes DELETE
    private static function handleDeleteRequest()
    {
        $resources = self::getUriSegments();

        if (count($resources) == 2 && isset($resources[1]) && is_numeric($resources[1])) {
            self::deleteProduct($resources[1]);
        } else {
            self::sendOutput('Invalid endpoint or parameters', array('HTTP/1.1 404 Not Found'));
        }
    }
    //---------------------------------------------REQUEST HANDLERS---------------------------------------------

    //---------------------------------------------PRODUCT ACTIONS----------------------------------------------
    private static function getAllProducts()
    {
        try {
            $products = ProductDAO::getAllProducts();
            self::sendOutput(json_encode($products), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    private static function getProductById($productId)
    {
        try {
            $product = ProductDAO::getProductByID($productId);
            self::sendOutput(json_encode($product), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    private static function createProduct($data)
    {
        $newProduct = new ProductModel(
            null,
            $data['color'],
            $data['size'],
            $data['stock'],
            $data['imageRoute'],
            $data['productTypeID']
        );

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

    private static function updateProduct($data)
    {
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

    private static function deleteProduct($productId)
    {
        try {
            $result = ProductDAO::deleteProduct($productId);
            if ($result) {
                self::sendOutput('Product deleted successfully', array('HTTP/1.1 200 OK'));
            } else {
                self::sendOutput('Failed to delete product', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }
    //---------------------------------------------PRODUCT ACTIONS----------------------------------------------
}
?>
