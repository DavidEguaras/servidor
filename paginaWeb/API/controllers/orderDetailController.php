<?php

require_once 'model/dataAccessObject/orderDetailDao.php'; 
require_once 'model/objectModels/orderDetailModel.php';
require_once 'paramValidators/paramValidator.php'; 

class OrderDetailController extends BaseController
{

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
        self::getOrderDetailsByORDER_ID();
    }

    private static function handlePostRequest(){
        self::createOrderDetail();
    }
    //=============================!REQUEST HANDLERS=============================



    //=============================ORDER DETAIL ACTIONS=============================
    public static function createOrderDetail(){
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);

        $error = "";
        $requiredParams = ['quantity', 'totalPrice', 'ORDER_ID', 'PRODUCT_ID'];

        if(!ParamValidator::validateParams($data, $requiredParams, $error)){
            self::sendOutput('Missing required parameters "' . $error . '"', array('HTTP/1.1 400 Bad Request'));
            return;
        }

        $quantity = $data['quantity'];
        $totalPrice = $data['totalPrice'];
        $ORDER_ID = $data['ORDER_ID'];
        $PRODUCT_ID = $data['PRODUCT_ID'];
        $newOrderDetail = new OrderDetailModel($quantity, $totalPrice, $ORDER_ID, $PRODUCT_ID);

        try {
            $result = OrderDetailDao::createOrderDetail($newOrderDetail);
            if ($result) {
                self::sendOutput('Order detail created successfully', array('HTTP/1.1 201 Created'));
            } else {
                self::sendOutput('Failed to create order detail', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public static function getOrderDetailsByORDER_ID(){
        $ORDER_ID = $_GET['ORDER_ID'] ?? null;
        if ($ORDER_ID === null) {
            self::sendOutput('Missing ORDER_ID parameter', array('HTTP/1.1 400 Bad Request'));
            return;
        }

        try {
            $orderDetails = OrderDetailDao::getOrderDetailsByOrderID($ORDER_ID);
            if ($orderDetails !== null) {
                self::sendOutput(json_encode($orderDetails), array('HTTP/1.1 200 OK'));
            } else {
                self::sendOutput('No order details found for ORDER_ID ' . $ORDER_ID, array('HTTP/1.1 404 Not Found'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public static function getOrderDetailByDetailID($DETAIL_ID){
        try {
            $orderDetail = OrderDetailDao::getOrderDetailByDetailID($DETAIL_ID);
            if ($orderDetail !== null) {
                self::sendOutput(json_encode($orderDetail), array('HTTP/1.1 200 OK'));
            } else {
                self::sendOutput('No order detail found for DETAIL_ID ' . $DETAIL_ID, array('HTTP/1.1 404 Not Found'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }
    
    //=============================!ORDER DETAIL ACTIONS=============================
}

?>
