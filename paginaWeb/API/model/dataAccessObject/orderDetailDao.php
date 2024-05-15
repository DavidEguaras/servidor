<?php

class OrderDetailDAO extends Factory {
    // Método para construir un objeto OrderDetail a partir de los datos obtenidos de la base de datos
    public static function buildOrderDetailModel($orderDetailData) {
        if ($orderDetailData) {
            return array(
                'DETAIL_ID' => $orderDetailData['DETAIL_ID'],
                'quantity' => $orderDetailData['quantity'],
                'total_price' => $orderDetailData['total_price'],
                'ORDER_ID' => $orderDetailData['ORDER_ID'],
                'PRODUCT_ID' => $orderDetailData['PRODUCT_ID']
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
            $orderDetail->ORDER_ID,
            $orderDetail->PRODUCT_ID
        );
        
        try {
            self::select($query, $params);
            return $orderDetail;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Método para obtener todos los detalles de orden de una orden específica
    public static function getOrderDetailsByORDER_ID($ORDER_ID) {
        $query = "SELECT * FROM OrderDetail WHERE ORDER_ID = ?";
        $params = array($ORDER_ID);
        
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
