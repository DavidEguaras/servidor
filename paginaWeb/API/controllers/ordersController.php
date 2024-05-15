<?php
require_once 'model/dataAccessObject/ordersDao.php'; // Incluir la definición de la clase OrderDAO
require_once 'model/objectModels/ordersModel.php'; // Incluir la definición de la clase OrderModel
require_once 'paramValidators/paramValidator.php';
class OrderController extends BaseController
{


    public static function method()
    {
        // SWITCH METHOD
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


    //=====================================REQUEST HANDLERS=====================================
     private static function handleGetRequest(){
        $resources = self::getUriSegments();
        $filters = self::getQueryStringParams();

        if (count($resources) == 3 && count($filters) == 0) {
            self::getOrderById($resources[2]);
        } elseif (count($resources) == 4 && count($filters) == 0 && $resources[3] == 'user') {
            self::getOrdersByUSER_ID($resources[2]);
        } else {
            self::sendOutput('Invalid endpoint or parameters', array('HTTP/1.1 404 Not Found'));
        }
     }
 
    private static function handlePostRequest(){
        self::createOrder();
    }
 
    // private static function handlePutRequest(){
 
    // }
 
    // private static function handlePatchRequest(){
 
    // }
 
    private static function handleDeleteRequest(){
        $resources = self::getUriSegments();
        if (count($resources) == 3) {
            self::deleteOrderById($resources[2]);
        } else {
            self::sendOutput('Invalid endpoint or parameters', array('HTTP/1.1 404 Not Found'));
        }
    }
    //=====================================!REQUEST HANDLERS=====================================



    public static function createOrder()
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);
        $error = "";

        $requiredParams = ['order_date', 'direction','payment', 'total', 'USER_ID'];

        if(!ParamValidator::validateParams($data, $requiredParams, $error)){
            self::sendOutput('Missing required paramaters "' .$error . '"', array('HTTP/1.1 400 Bad Request'));
        }
        
        // Obtener los datos necesarios para crear una nueva orden
        $order_date = $data['order_date'];
        $direction = $data['direction'];
        $payment = $data['payment'];
        $total = $data['total'];
        $USER_ID = $data['USER_ID'];

        // Crear un nuevo objeto OrderModel con los datos proporcionados
        $newOrder = new OrderModel($order_date, $direction, $payment, $total, $USER_ID);

        // Llamar al método createOrder en OrderDAO para agregar la nueva orden a la base de datos
        try {
            $result = OrderDao::createOrder($newOrder);
            if ($result) {
                self::sendOutput('Order created successfully', array('HTTP/1.1 201 Created'));
            } else {
                self::sendOutput('Failed to create order', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public static function getOrderById($ORDER_ID)
    {
        try {
            $order = OrderDao::getOrderById($ORDER_ID);
            self::sendOutput(json_encode($order), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public static function getOrdersByUSER_ID($USER_ID)
    {
        try {
            $orders = OrderDao::getOrdersByUSER_ID($USER_ID);
            self::sendOutput(json_encode($orders), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public static function deleteOrderById($ORDER_ID)
    {
        try {
            $result = OrderDao::deleteOrderById($ORDER_ID);
            if ($result) {
                self::sendOutput('Order deleted successfully', array('HTTP/1.1 200 OK'));
            } else {
                self::sendOutput('Failed to delete order', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }
}

?>