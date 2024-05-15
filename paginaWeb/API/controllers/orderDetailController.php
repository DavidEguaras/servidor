<?php

require_once 'model/dataAccessObject/orderDetailDao.php'; // Incluir la definición de la clase UserDAO
require_once 'model/objectModels/orderDetailModel.php'; // Incluir la definición de la clase UserModel
require_once 'paramValidators/paramValidator.php'; // Incluir el validador de parámetros



class orderDetailController extends BaseController
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



    public static function createOrderDetail($orderDetail){
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
        $newOrderDetail = new orderDetailModel($quantity, $totalPrice, $ORDER_ID, $PRODUCT_ID);

        try {
            $result = OrderDetailDao::createOrderDetail($newOrderDetail);
            if ($result) {
                self::sendOutput('User created successfully', array('HTTP/1.1 201 Created'));
            } else {
                self::sendOutput('Failed to create user', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            self::sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public static function getOrderDetailsByORDER_ID(){
        
    }

    
}



?>
