<?php

class CartDAO extends Factory {
    public static function buildCartModel($cartData) {
        if ($cartData) {
            return new Cart(
                $cartData['cartID'],
                $cartData['lastUpdate'],
                $cartData['quantity'],
                $cartData['userID'],
                $cartData['productID']
            );
        } else {
            return null;
        }
    }

    public static function createCart(Cart $cart) {
        $query = "INSERT INTO Cart (cartID, lastUpdate, quantity, userID, productID) VALUES (?, ?, ?, ?, ?)";
        $params = array(
            $cart->cartID,
            $cart->lastUpdate,
            $cart->quantity,
            $cart->userID,
            $cart->productID
        );
        
        try {
            self::select($query, $params);
            return $cart;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getCartByUserID($userID) {
        $query = "SELECT * FROM Cart WHERE userID = ?";
        $params = array($userID);
        
        try {
            $result = self::select($query, $params);
            $carts = array();
            foreach ($result as $cartData) {
                $carts[] = self::buildCartModel($cartData);
            }
            return $carts;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function updateCartQuantity($cartID, $newQuantity) {
        $query = "UPDATE Cart SET quantity = ? WHERE cartID = ?";
        $params = array($newQuantity, $cartID);
        
        try {
            self::select($query, $params);
            return true; // Retorna true si se actualizó correctamente
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    //revisar
    public static function deleteCart($cartID) {
        $query = "DELETE FROM Cart WHERE cartID = ?";
        $params = array($cartID);
        
        try {
            self::select($query, $params);
            return true; // Retorna true si se eliminó correctamente
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function clearCartByUserID($userID) {
        $query = "DELETE FROM Cart WHERE userID = ?";
        $params = array($userID);
        
        try {
            self::select($query, $params);
            return true; // Retorna true si se limpió el carrito correctamente
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getTotalProductsInCart($userID) {
        $query = "SELECT SUM(quantity) AS total FROM Cart WHERE userID = ?";
        $params = array($userID);
        
        try {
            $result = self::select($query, $params);
            return $result[0]['total']; // Retorna el total de productos en el carrito
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getAllProductsInCart($userID) {
        $query = "SELECT * FROM Cart WHERE userID = ?";
        $params = array($userID);
        
        try {
            $result = self::select($query, $params);
            $carts = array();
            foreach ($result as $cartData) {
                $carts[] = self::buildCartModel($cartData);
            }
            return $carts; // Retorna todos los productos en el carrito
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}

?>
