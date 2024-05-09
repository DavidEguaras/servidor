<?php

require_once 'model/dataAccessObject/orderDetailDao.php'; // Incluir la definición de la clase OrderDetailDAO
require_once 'model/objectModels/orderDetailModel.php'; // Incluir la definición de la clase OrderDetail
require_once 'validators/paramValidator.php'; // Incluir el validador de parámetros

class OrderDetailController extends BaseController
{
    private static $orderDetailDao;

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
            /*
            case 'PUT':
                self::handlePutRequest();
                break;
            case 'PATCH':
                self::handlePatchRequest();
                break;
            case 'DELETE':
                self::handleDeleteRequest();
                break;  
            */
            default:
                self::sendOutput('Invalid request method', array('HTTP/1.1 405 Method Not Allowed'));
                break;
        }
    }

    //=============================REQUEST HANDLERS=============================
    private static function handleGetRequest(){
        if(isset($_GET['orderID'])) {
            $orderID = $_GET['orderID'];
            try {
                $orderDetails = self::$orderDetailDao->getOrderDetailsByOrderId($orderID);
                if($orderDetails) {
                    self::sendOutput($orderDetails, array('HTTP/1.1 200 OK'));
                } else {
                    self::sendOutput('No order details found for the provided orderID', array('HTTP/1.1 404 Not Found'));
                }
            } catch (Exception $e) {
                self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
            }
        } else {
            self::sendOutput('Missing orderID parameter', array('HTTP/1.1 400 Bad Request'));
        }
    }

    private static function handlePostRequest(){
        $requestBody = file_get_contents('php://input');
        $orderDetailData = json_decode($requestBody, true);
        if ($orderDetailData) {
            // Validar los datos del detalle de orden recibidos
            $requiredParams = ['quantity', 'totalPrice', 'orderID', 'productID'];
            $error = '';
            if (!ParamValidator::validateParams($orderDetailData, $requiredParams, $error)) {
                self::sendOutput('Missing required parameter: ' . $error, array('HTTP/1.1 400 Bad Request'));
                return;
            }

            // Crear un nuevo objeto OrderDetail
            $newOrderDetail = new OrderDetail(
                null, // No es necesario proporcionar detailID ya que es autoincremental
                $orderDetailData['quantity'],
                $orderDetailData['totalPrice'],
                $orderDetailData['orderID'],
                $orderDetailData['productID']
            );

            try {
                // Intentar crear el detalle de orden en la base de datos
                $result = self::$orderDetailDao->createOrderDetail($newOrderDetail);
                if ($result) {
                    self::sendOutput('Order detail created successfully', array('HTTP/1.1 201 Created'));
                } else {
                    self::sendOutput('Failed to create order detail', array('HTTP/1.1 500 Internal Server Error'));
                }
            } catch (Exception $e) {
                self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
            }
        } else {
            self::sendOutput('Invalid JSON data', array('HTTP/1.1 400 Bad Request'));
        }
    }
    //=============================!REQUEST HANDLERS=============================

}

?>

?>
