<?php
require_once 'model/dataAccessObject/cartDao.php'; // Incluir la definición de la clase UserDAO
require_once 'model/objectModels/cartModel.php'; // Incluir la definición de la clase UserModel
require_once 'paramValidators/paramValidator.php'; // Incluir el validador de parámetros

class CartController extends BaseController
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
        $USER_ID = $_GET['USER_ID'] ?? null;

        if ($USER_ID !== null) {
            self::getCartByUSER_ID($USER_ID);
        } else {
            self::sendOutput('Missing user ID', array('HTTP/1.1 400 Bad Request'));
        }
    }

    
    private static function handlePostRequest()
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);

        // Validar los datos recibidos
        $requiredParams = ['last_update', 'quantity', 'USER_ID', 'PRODUCT_ID'];
        $error = '';

        if (!ParamValidator::validateParams($data, $requiredParams, $error)) {
            self::sendOutput('Missing required parameter: ' . $error, array('HTTP/1.1 400 Bad Request'));
            return;
        }

        // Crear un nuevo objeto CartModel
        $newCart = new CartModel(
            $data['last_update'],
            $data['quantity'],
            $data['USER_ID'],
            $data['PRODUCT_ID']
        );

        try {
            // Intentar crear el carrito en la base de datos
            $result = CartDao::createCart($newCart);
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

        $CART_ID = $data['CART_ID'] ?? null;
        $newQuantity = $data['quantity'] ?? null;

        if ($CART_ID !== null && $newQuantity !== null) {
            try {
                $result = CartDao::updateCartQuantity($CART_ID, $newQuantity);
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
        $requiredParams = ['last_update', 'quantity', 'USER_ID', 'PRODUCT_ID'];
        $error = '';

        if (!ParamValidator::validateParams($cart, $requiredParams, $error)) {
            self::sendOutput('Missing required parameter: ' . $error, array('HTTP/1.1 400 Bad Request'));
            return;
        }

        // Crear un nuevo objeto CartModel
        $newCart = new CartModel(
            $cart['last_update'],
            $cart['quantity'],
            $cart['USER_ID'],
            $cart['PRODUCT_ID']
        );

        try {
            // Intentar crear el carrito en la base de datos
            $result = CartDao::createCart($newCart);
            if ($result) {
                self::sendOutput('Cart created successfully', array('HTTP/1.1 201 Created'));
            } else {
                self::sendOutput('Failed to create cart', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }


    public static function getCartByUSER_ID($USER_ID)
    {
        try {
            $carts = CartDao::getCartByUSER_ID($USER_ID);
            self::sendOutput(json_encode($carts), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }


    public static function updateCartQuantity($CART_ID, $newQuantity)
    {
        try {
            $result = CartDao::updateCartQuantity($CART_ID, $newQuantity);
            if ($result) {
                self::sendOutput('Cart quantity updated successfully', array('HTTP/1.1 200 OK'));
            } else {
                self::sendOutput('Failed to update cart quantity', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }


    public static function deleteCart($CART_ID)
    {
        try {
            $result = CartDao::deleteCart($CART_ID);
            if ($result) {
                self::sendOutput('Cart deleted successfully', array('HTTP/1.1 200 OK'));
            } else {
                self::sendOutput('Failed to delete cart', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }


    public static function clearCartByUSER_ID($USER_ID)
    {
        try {
            $result = CartDao::clearCartByUSER_ID($USER_ID);
            if ($result) {
                self::sendOutput('Cart cleared successfully', array('HTTP/1.1 200 OK'));
            } else {
                self::sendOutput('Failed to clear cart', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }


    public static function getTotalProductsInCart($USER_ID)
    {
        try {
            $totalProducts = CartDao::getTotalProductsInCart($USER_ID);
            self::sendOutput(json_encode(['totalProducts' => $totalProducts]), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    
    public static function getAllProductsInCart($USER_ID)
    {
        try {
            $products = CartDao::getAllProductsInCart($USER_ID);
            self::sendOutput(json_encode($products), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }
}

?>