<?php

class OrderDAO extends Factory {
    // Método para construir un objeto Order a partir de los datos obtenidos de la base de datos
    public static function buildOrderModel($orderData) {
        if ($orderData) {
            return new Order(
                $orderData['orderID'],
                $orderData['orderDate'],
                $orderData['direction'],
                $orderData['payment'],
                $orderData['userID']
            );
        } else {
            return null;
        }
    }

    // Método para crear una nueva orden en la base de datos
    public static function createOrder($order) {
        $query = "INSERT INTO ORDERS VALUES (NULL, ?, ?, ?, ?)";
        $params = array(
            $order->orderDate,
            $order->direction,
            $order->payment,
            $order->userID
        );
        
        try {
            self::select($query, $params);
            return $order;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Método para obtener una orden por su ID
    public static function getOrderById($orderID) {
        $query = "SELECT * FROM `Order` WHERE orderID = ?";
        $params = array($orderID);
        
        try {
            $result = self::select($query, $params);
            return self::buildOrderModel($result[0]);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Método para obtener todas las órdenes de un usuario
    public static function getOrdersByUserId($userID) {
        $query = "SELECT * FROM `Order` WHERE userID = ?";
        $params = array($userID);
        
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

    // Método para eliminar una orden por su ID
    public static function deleteOrderById($orderID) {
        $query = "DELETE FROM `Order` WHERE orderID = ?";
        $params = array($orderID);
        
        try {
            self::select($query, $params);
            return true; // Retorna true si se eliminó correctamente
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}

?>
