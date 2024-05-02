<?php
require_once 'model/dataAccessObject/productTypeDao.php'; // Incluir la definición de la clase UserDAO
require_once 'model/objectModels/productTypeModel.php'; // Incluir la definición de la clase UserModel

class productTypeController extends BaseController

{
    private static $productTypeDAO;

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

    public static function createProductType($productType)
    {

    }

    public static function getProductTypeByID($ptID)
    {

    }

    public static function updateProductType($productType)
    {

    }

    public static function deleteProductType($productID)
    {

    }

    public static function getAllProductTypes()
    {

    }
    
    public static function getProductTypesByCategory($category)
    {

    }

    public static function getProductTypesByBrand($brand)
    {

    }

    public static function getProductCountByType($ptID)
    {
        
    }

}

?>