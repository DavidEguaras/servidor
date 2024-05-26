<?php

class ProductDAO extends Factory {
    public static function buildProductModel($productData) {
        if ($productData) {
            return array(
                'PRODUCT_ID' => $productData['PRODUCT_ID'],
                'color' => $productData['color'],
                'size' => $productData['size'],
                'stock' => $productData['stock'],
                'image_route' => $productData['image_route'],
                'PT_ID' => $productData['PT_ID'],
                'name' => $productData['name'],
                'price' => $productData['price'],
                'description' => $productData['description'],
                'brand' => $productData['brand']
            );
        } else {
            return null;
        }
    }

    public static function createProduct($product) {
        $query = "INSERT INTO Product VALUES (NULL, ?, ?, ?, ?, ?)";
        $params = array(
            $product->color,
            $product->size,
            $product->stock,
            $product->image_route,
            $product->PT_ID
        );

        try {
            self::select($query, $params);
            return $product;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getProductByID($PRODUCT_ID) {
        $query = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = ?";
        $params = array($PRODUCT_ID);

        try {
            $result = self::select($query, $params);
            return self::buildProductModel($result[0]);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function updateProductQuantity($PRODUCT_ID, $newQuantity) {
        $query = "UPDATE PRODUCT SET stock = stock - ? WHERE PRODUCT_ID = ?";
        $params = array($newQuantity, $PRODUCT_ID);
    
        try {
            self::select($query, $params);
            return true; // Retorna true si se actualizó correctamente
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getProductWithDetailsByID($PRODUCT_ID) {
        $query = "SELECT PRODUCT.*, PRODUCT_TYPE.name, PRODUCT_TYPE.price, PRODUCT_TYPE.description, PRODUCT_TYPE.brand 
                  FROM PRODUCT 
                  JOIN PRODUCT_TYPE ON PRODUCT.PT_ID = PRODUCT_TYPE.PT_ID 
                  WHERE PRODUCT.PRODUCT_ID = ?";
        $params = array($PRODUCT_ID);

        try {
            $result = self::select($query, $params);
            return self::buildProductModel($result[0]);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function deleteProduct($PRODUCT_ID) {
        $query = "DELETE FROM PRODUCT WHERE PRODUCT_ID = ?";
        $params = array($PRODUCT_ID);

        try {
            self::select($query, $params);
            return true; // si se eliminó correctamente
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getAllProducts() {
        $query = "SELECT * FROM PRODUCT";

        try {
            $result = self::select($query);
            $products = array();
            foreach ($result as $productData) {
                $products[] = self::buildProductModel($productData);
            }
            return $products; // Retorna todos los productos
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}

?>
