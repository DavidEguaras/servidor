<?php

class OrderDAO extends Factory {
    // Metodo para construir un objeto Order a partir de los datos obtenidos de la base de datos
    public static function buildOrderModel($orderData) {
        if ($orderData) {
            return array(
                'ORDER_ID' =>$orderData['ORDER_ID'],
                'order_date' =>$orderData['order_date'],
                'direction' =>$orderData['direction'],
                'payment' =>$orderData['payment'],
                'total' =>$orderData['total'],
                'USER_ID' =>$orderData['USER_ID']
            );
        } else {
            return null;
        }
    }

    // Metodo para crear una nueva orden en la base de datos
    public static function createOrder($order) {
        $query = "INSERT INTO ORDERS VALUES (NULL, ?, ?, ?, ?, ?)";
        $params = array(
            $order->order_date,
            $order->direction,
            $order->payment,
            $order->total,
            $order->USER_ID
        );
        
        try {
            self::select($query, $params);
            return $order;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Metodo para obtener una orden por su ID
    public static function getOrderById($ORDER_ID) {
        $query = "SELECT * FROM ORDERS WHERE ORDER_ID = ?";
        $params = array($ORDER_ID);
        
        try {
            $result = self::select($query, $params);
            return self::buildOrderModel($result[0]);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Metodo para obtener todas las órdenes de un usuario
    public static function getOrdersByUSER_ID($USER_ID) {
        $query = "SELECT * FROM ORDERS WHERE USER_ID = ?";
        $params = array($USER_ID);
        
        try {
            $result = self::select($query, $params);
            $orders = array();
            foreach ($result as $orderData) {
                $orders[] = self::buildOrderModel($orderData);
            }
            return $orders;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Metodo para eliminar una orden por su ID
    public static function deleteOrderById($ORDER_ID) {
        $query = "DELETE FROM ORDERS WHERE ORDER_ID = ?";
        $params = array($ORDER_ID);
        
        try {
            self::select($query, $params);
            return true;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}

?>
