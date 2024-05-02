<?php
require_once 'model/dataAccessObject/productDao.php'; // Incluir la definición de la clase UserDAO
require_once 'model/objectModels/productModel.php'; // Incluir la definición de la clase UserModel


class ProductController extends BaseController
{
    private static $productDAO;

    public static function method()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        switch($requestMethod){
            case 'GET':
                break;
            case 'POST':
                break;
            case 'PUT':
                break;
            case 'PATCH':
                break;
            case 'DELETE':
                break;  
            default:
                self::sendOutput('Invalid request method', array('HTTP/1.1 405 Method Not Allowed'));
                break;
        }
    }


    public static function createProduct($product)
    {

    }

    public static function getProductById($productID)
    {

    }

    public static function updateProductStock($productID, $newStock)
    {

    }

    public static function deleteProduct($productID)
    {
        
    }

    public static function getAllProducts()
    {

    }

    public static function getProductByType($productTypeID)
    {

    }

    public static function updateProductInfo($productID, $newColor, $newSize, $newStock, $newImageRoute){
        
    }
}

?>


