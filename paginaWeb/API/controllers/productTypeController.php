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