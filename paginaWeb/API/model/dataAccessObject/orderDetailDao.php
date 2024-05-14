<?php

class OrderDetailDAO extends Factory {
    // Método para construir un objeto OrderDetail a partir de los datos obtenidos de la base de datos
    public static function buildOrderDetailModel($orderDetailData) {
        if ($orderDetailData) {
            return new orderDetail(
                $orderDetailData['detailID'],
                $orderDetailData['quantity'],
                $orderDetailData['totalPrice'],
                $orderDetailData['orderID'],
                $orderDetailData['productID']
            );
        } else {
            return null;
        }
    }

    // Método para crear un nuevo detalle de orden en la base de datos
    public static function createOrderDetail($orderDetail) {
        $query = "INSERT INTO OrderDetail VALUES (NULL, ?, ?, ?, ?)";
        $params = array(
            $orderDetail->quantity,
            $orderDetail->totalPrice,
            $orderDetail->orderID,
            $orderDetail->productID
        );
        
        try {
            self::select($query, $params);
            return $orderDetail;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Método para obtener todos los detalles de orden de una orden específica
    public static function getOrderDetailsByOrderId($orderID) {
        $query = "SELECT * FROM OrderDetail WHERE orderID = ?";
        $params = array($orderID);
        
        try {
            $result = self::select($query, $params);
            $orderDetails = array();
            foreach ($result as $orderDetailData) {
                $orderDetails[] = self::buildOrderDetailModel($orderDetailData);
            }
            return $orderDetails;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}

?>
