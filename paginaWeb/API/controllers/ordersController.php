<?php
require_once 'model/dataAccessObject/ordersDao.php'; // Incluir la definición de la clase OrderDAO
require_once 'model/objectModels/ordersModel.php'; // Incluir la definición de la clase OrderModel

class OrderController extends BaseController
{
    private static $orderDAO;

    public static function method()
    {
        // SWITCH METHOD
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        switch ($requestMethod) {
            case 'GET':
                $resources = self::getUriSegments();
                $filters = self::getQueryStringParams();

                if (count($resources) == 3 && count($filters) == 0) {
                    self::getOrderById($resources[2]);
                } elseif (count($resources) == 4 && count($filters) == 0 && $resources[3] == 'user') {
                    self::getOrdersByUserId($resources[2]);
                } else {
                    self::sendOutput('Invalid endpoint or parameters', array('HTTP/1.1 404 Not Found'));
                }
                break;

            case 'POST':
                self::createOrder();
                break;

            case 'DELETE':
                $resources = self::getUriSegments();
                if (count($resources) == 3) {
                    self::deleteOrderById($resources[2]);
                } else {
                    self::sendOutput('Invalid endpoint or parameters', array('HTTP/1.1 404 Not Found'));
                }
                break;

            default:
                self::sendOutput('Invalid request method', array('HTTP/1.1 405 Method Not Allowed'));
                break;
        }
    }

    public static function createOrder()
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);
        
        // Obtener los datos necesarios para crear una nueva orden
        $orderID = isset($data['orderID']) ? $data['orderID'] : null;
        $orderDate = isset($data['orderDate']) ? $data['orderDate'] : null;
        $direction = isset($data['direction']) ? $data['direction'] : null;
        $payment = isset($data['payment']) ? $data['payment'] : null;
        $userID = isset($data['userID']) ? $data['userID'] : null;

        // Crear un nuevo objeto OrderModel con los datos proporcionados
        $newOrder = new OrderModel($orderID, $orderDate, $direction, $payment, $userID);

        // Llamar al método createOrder en OrderDAO para agregar la nueva orden a la base de datos
        try {
            $result = self::$orderDAO->createOrder($newOrder);
            if ($result) {
                self::sendOutput('Order created successfully', array('HTTP/1.1 201 Created'));
            } else {
                self::sendOutput('Failed to create order', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public static function getOrderById($orderId)
    {
        try {
            $order = self::$orderDAO->getOrderById($orderId);
            self::sendOutput(json_encode($order), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public static function getOrdersByUserId($userId)
    {
        try {
            $orders = self::$orderDAO->getOrdersByUserId($userId);
            self::sendOutput(json_encode($orders), array('HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public static function deleteOrderById($orderId)
    {
        try {
            $result = self::$orderDAO->deleteOrderById($orderId);
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