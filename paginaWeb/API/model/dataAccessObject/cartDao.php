<?php

class CartDAO extends Factory {
    public static function buildCartModel($cartData) {
        if ($cartData) {
            return array(
                'CART_ID' =>$cartData['CART_ID'],
                'last_update' =>$cartData['last_update'],
                'quantity' =>$cartData['quantity'],
                'USER_ID' =>$cartData['USER_ID'],
                'PRODUCT_ID' =>$cartData['PRODUCT_ID']
            );
        } else {
            return null;
        }
    }

    public static function createCart(Cart $cart) {
        $query = "INSERT INTO CART VALUES (NULL, ?, ?, ?, ?)";
        $params = array(
            $cart->last_update,
            $cart->quantity,
            $cart->USER_ID,
            $cart->PRODUCT_ID
        );
        
        try {
            self::select($query, $params);
            return $cart;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getCartByUSER_ID($USER_ID) {
        $query = "SELECT * FROM CART WHERE USER_ID = ?";
        $params = array($USER_ID);
        
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

    public static function updateCartQuantity($CART_ID, $newQuantity) {
        $query = "UPDATE Cart SET quantity = ? WHERE CART_ID = ?";
        $params = array($newQuantity, $CART_ID);
        
        try {
            self::select($query, $params);
            return true; // Retorna true si se actualizó correctamente
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    //revisar
    public static function deleteCart($CART_ID) {
        $query = "DELETE FROM Cart WHERE CART_ID = ?";
        $params = array($CART_ID);
        
        try {
            self::select($query, $params);
            return true; // Retorna true si se eliminó correctamente
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function clearCartByUSER_ID($USER_ID) {
        $query = "DELETE FROM Cart WHERE USER_ID = ?";
        $params = array($USER_ID);
        
        try {
            self::select($query, $params);
            return true; // Retorna true si se limpió el carrito correctamente
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getTotalProductsInCart($USER_ID) {
        $query = "SELECT SUM(quantity) AS total FROM Cart WHERE USER_ID = ?";
        $params = array($USER_ID);
        
        try {
            $result = self::select($query, $params);
            return $result[0]['total']; // Retorna el total de productos en el carrito
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getAllProductsInCart($USER_ID) {
        $query = "SELECT * FROM Cart WHERE USER_ID = ?";
        $params = array($USER_ID);
        
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
