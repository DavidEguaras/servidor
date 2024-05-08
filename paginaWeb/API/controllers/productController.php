<?php
require_once 'model/dataAccessObject/productDao.php'; // Incluir la definición de la clase UserDAO
require_once 'model/objectModels/productModel.php'; // Incluir la definición de la clase UserModel
require_once 'validators/paramValidator.php'; // Incluir el validador de parámetros



class ProductController extends BaseController
{
    private static $productDAO;

    public static function method()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        switch($requestMethod){
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

    //=============================REQUEST HANDLERS=============================
    private static function handleGetRequest(){

    }

    private static function handlePostRequest(){
        
    }

    private static function handlePutRequest(){

    }

    private static function handlePatchRequest(){

    }

    private static function handleDeleteRequest(){

    }
    //=============================!REQUEST HANDLERS=============================



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


