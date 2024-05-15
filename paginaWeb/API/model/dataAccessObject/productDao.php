<?php

class ProductDAO extends Factory {
    public static function buildProductModel($productData) {
        if ($productData) {
            return new Product(
                $productData['PRODUCT_ID'],
                $productData['color'],
                $productData['size'],
                $productData['stock'],
                $productData['imageRoute'],
                $productData['PT_ID']
            );
        } else {
            return null;
        }
    }

    // Método para crear un nuevo producto en la base de datos
    public static function createProduct($product) {
        $query = "INSERT INTO Product  VALUES (NULL, ?, ?, ?, ?, ?)";
        $params = array(
            $product->color,
            $product->size,
            $product->stock,
            $product->imageRoute,
            $product->PT_ID
        );
        
        try {
            self::select($query, $params);
            return $product;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Método para obtener un producto por su ID de producto
    public static function getProductByID($PRODUCT_ID) {
        $query = "SELECT * FROM Product WHERE PRODUCT_ID = ?";
        $params = array($PRODUCT_ID);
        
        try {
            $result = self::select($query, $params);
            return self::buildProductModel($result[0]);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Método para actualizar el stock de un producto en la base de datos
    public static function updateProductStock($PRODUCT_ID, $newStock) {
        $query = "UPDATE Product SET stock = ? WHERE PRODUCT_ID = ?";
        $params = array($newStock, $PRODUCT_ID);
        
        try {
            self::select($query, $params);
            return true; // Retorna true si se actualizó correctamente
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Método para eliminar un producto de la base de datos por su ID de producto
    public static function deleteProduct($PRODUCT_ID) {
        $query = "DELETE FROM Product WHERE PRODUCT_ID = ?";
        $params = array($PRODUCT_ID);
        
        try {
            self::select($query, $params);
            return true; // Retorna true si se eliminó correctamente
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Método para obtener todos los productos de la base de datos
    public static function getAllProducts() {
        $query = "SELECT * FROM Product";
        
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

    // Método para obtener productos por su tipo de producto
    public static function getProductsByType($PT_ID) {
        $query = "SELECT * FROM Product WHERE PT_ID = ?";
        $params = array($PT_ID);
        
        try {
            $result = self::select($query, $params);
            $products = array();
            foreach ($result as $productData) {
                $products[] = self::buildProductModel($productData);
            }
            return $products; // Retorna los productos del tipo especificado
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Método para actualizar la información de un producto en la base de datos
    public static function updateProductInfo($PRODUCT_ID, $newColor, $newSize, $newStock, $newImageRoute) {
        $query = "UPDATE Product SET color = ?, size = ?, stock = ?, imageRoute = ? WHERE PRODUCT_ID = ?";
        $params = array($newColor, $newSize, $newStock, $newImageRoute, $PRODUCT_ID);
        
        try {
            self::select($query, $params);
            return true; // Retorna true si se actualizó correctamente
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}

?>
