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

    private static function handleGetRequest()
    {
        $resources = self::getUriSegments();
        $filters = self::getQueryStringParams();

        if (count($resources) == 2 && count($filters) == 0) {
            self::getAllProducts();
        } elseif (count($resources) == 3 && count($filters) == 0) {
            self::getProductsWithDetailById($resources[2]);
        } else {
            self::sendOutput('Invalid endpoint or parameters', array('HTTP/1.1 404 Not Found'));
        }
    }

    private static function handlePostRequest()
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);

        $requiredParams = ['color', 'size', 'stock', 'image_route', 'PT_ID'];
        $error = '';
        if (!ParamValidator::validateParams($data, $requiredParams, $error)) {
            self::sendOutput('Missing required parameters: ' . $error, array('HTTP/1.1 400 Bad Request'));
            return;
        }

        self::createProduct($data);
    }

    private static function handlePutRequest()
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);

        $requiredParams = ['PRODUCT_ID', 'quantity'];
        $error = '';
        if (!ParamValidator::validateParams($data, $requiredParams, $error)) {
            self::sendOutput('Missing required parameters: ' . $error, array('HTTP/1.1 400 Bad Request'));
            return;
        }

        self::updateProductQuantity($data);
    }

    private static function handleDeleteRequest()
    {
        $resources = self::getUriSegments();

        if (count($resources) == 3 && isset($resources[2]) && is_numeric($resources[2])) {
            self::deleteProduct($resources[2]);
        } else {
            self::sendOutput('Invalid endpoint or parameters', array('HTTP/1.1 404 Not Found'));
        }
    }

    private static function getAllProducts()
    {
        try {
            $products = ProductDAO::getAllProducts();
            self::sendOutput(json_encode($products), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    private static function getProductsWithDetailById($PRODUCT_ID)
    {
        try {
            $product = ProductDAO::getProductWithDetailsByID($PRODUCT_ID);
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
            $data['image_route'],
            $data['PT_ID']
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

    private static function updateProductQuantity($data) {
        try {
            $result = ProductDAO::updateProductQuantity(
                $data['PRODUCT_ID'],
                $data['quantity']
            );
            if ($result) {
                self::sendOutput('Product updated successfully', array('HTTP/1.1 201 OK'));
            } else {
                self::sendOutput('Failed to update product', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    private static function deleteProduct($PRODUCT_ID)
    {
        try {
            $result = ProductDAO::deleteProduct($PRODUCT_ID);
            if ($result) {
                self::sendOutput('Product deleted successfully', array('HTTP/1.1 200 OK'));
            } else {
                self::sendOutput('Failed to delete product', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }
}