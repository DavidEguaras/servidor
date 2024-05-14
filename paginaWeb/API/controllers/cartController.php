<?php
require_once 'model/dataAccessObject/cartDao.php'; // Incluir la definición de la clase UserDAO
require_once 'model/objectModels/cartModel.php'; // Incluir la definición de la clase UserModel
require_once 'paramValidators/paramValidator.php'; // Incluir el validador de parámetros

class CartController extends BaseController
{
    private static $cartDAO;

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

    //==========================================================REQUEST HANDLERS==========================================================
    private static function handleGetRequest()
    {
        // Obtener el ID del usuario desde la URL
        $userID = $_GET['userID'] ?? null;

        if ($userID !== null) {
            self::getCartByUserID($userID);
        } else {
            self::sendOutput('Missing user ID', array('HTTP/1.1 400 Bad Request'));
        }
    }

    
    private static function handlePostRequest()
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);

        // Validar los datos recibidos
        $requiredParams = ['lastUpdate', 'quantity', 'userID', 'productID'];
        $error = '';

        if (!ParamValidator::validateParams($data, $requiredParams, $error)) {
            self::sendOutput('Missing required parameter: ' . $error, array('HTTP/1.1 400 Bad Request'));
            return;
        }

        // Crear un nuevo objeto CartModel
        $newCart = new CartModel(
            $data['lastUpdate'],
            $data['quantity'],
            $data['userID'],
            $data['productID']
        );

        try {
            // Intentar crear el carrito en la base de datos
            $result = self::$cartDAO->createCart($newCart);
            if ($result) {
                self::sendOutput('Cart created successfully', array('HTTP/1.1 201 Created'));
            } else {
                self::sendOutput('Failed to create cart', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }


    private static function handlePutRequest()
    {
        parse_str(file_get_contents('php://input'), $data);

        $cartID = $data['cartID'] ?? null;
        $newQuantity = $data['quantity'] ?? null;

        if ($cartID !== null && $newQuantity !== null) {
            try {
                $result = self::$cartDAO->updateCartQuantity($cartID, $newQuantity);
                if ($result) {
                    self::sendOutput('Cart quantity updated successfully', array('HTTP/1.1 200 OK'));
                } else {
                    self::sendOutput('Failed to update cart quantity', array('HTTP/1.1 500 Internal Server Error'));
                }
            } catch (Exception $e) {
                self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
            }
        } else {
            self::sendOutput('Missing required parameters', array('HTTP/1.1 400 Bad Request'));
        }
    }
    //==========================================================!REQUEST HANDLERS==========================================================


    public static function createCart($cart)
    {
        // Validar los datos del carrito recibidos
        $requiredParams = ['lastUpdate', 'quantity', 'userID', 'productID'];
        $error = '';

        if (!ParamValidator::validateParams($cart, $requiredParams, $error)) {
            self::sendOutput('Missing required parameter: ' . $error, array('HTTP/1.1 400 Bad Request'));
            return;
        }

        // Crear un nuevo objeto CartModel
        $newCart = new CartModel(
            $cart['lastUpdate'],
            $cart['quantity'],
            $cart['userID'],
            $cart['productID']
        );

        try {
            // Intentar crear el carrito en la base de datos
            $result = self::$cartDAO->createCart($newCart);
            if ($result) {
                self::sendOutput('Cart created successfully', array('HTTP/1.1 201 Created'));
            } else {
                self::sendOutput('Failed to create cart', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }


    public static function getCartByUserID($userID)
    {
        try {
            $carts = self::$cartDAO->getCartByUserID($userID);
            self::sendOutput(json_encode($carts), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }


    public static function updateCartQuantity($cartID, $newQuantity)
    {
        try {
            $result = self::$cartDAO->updateCartQuantity($cartID, $newQuantity);
            if ($result) {
                self::sendOutput('Cart quantity updated successfully', array('HTTP/1.1 200 OK'));
            } else {
                self::sendOutput('Failed to update cart quantity', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }


    public static function deleteCart($cartID)
    {
        try {
            $result = self::$cartDAO->deleteCart($cartID);
            if ($result) {
                self::sendOutput('Cart deleted successfully', array('HTTP/1.1 200 OK'));
            } else {
                self::sendOutput('Failed to delete cart', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }


    public static function clearCartByUserID($userID)
    {
        try {
            $result = self::$cartDAO->clearCartByUserID($userID);
            if ($result) {
                self::sendOutput('Cart cleared successfully', array('HTTP/1.1 200 OK'));
            } else {
                self::sendOutput('Failed to clear cart', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }


    public static function getTotalProductsInCart($userID)
    {
        try {
            $totalProducts = self::$cartDAO->getTotalProductsInCart($userID);
            self::sendOutput(json_encode(['totalProducts' => $totalProducts]), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    
    public static function getAllProductsInCart($userID)
    {
        try {
            $products = self::$cartDAO->getAllProductsInCart($userID);
            self::sendOutput(json_encode($products), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }
}

?>