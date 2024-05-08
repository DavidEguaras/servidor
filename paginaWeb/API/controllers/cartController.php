<?php
require_once 'model/dataAccessObject/cartDao.php'; // Incluir la definición de la clase UserDAO
require_once 'model/objectModels/cartModel.php'; // Incluir la definición de la clase UserModel


class cartController extends BaseController
{
    private static $cartController;

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

    
    public static function createCart($cart)
    {

    }

    public static function getCartByUserID($userID)
    {

    }

    public static function updateCartQuantity($cartID, $newQuantity)
    {

    }

    public static function deleteCart($cartID)
    {

    }

    public static function clearCartByUserID($userID)
    {

    }

    public static function getTotalProductsInCart($userID)
    {

    }

    public static function getAllProductsInCart($userID)
    {
        
    }

}

?>