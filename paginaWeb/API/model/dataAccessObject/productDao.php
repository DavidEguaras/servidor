<?php

class ProductDAO extends Factory {
    public static function buildProductModel($productData) {
        if ($productData) {
            return new Product(
                $productData['productID'],
                $productData['color'],
                $productData['size'],
                $productData['stock'],
                $productData['imageRoute'],
                $productData['productTypeID']
            );
        } else {
            return null;
        }
    }

    // Metodo para crear un nuevo producto en la base de datos
    public static function createProduct($product) {
        $query = "INSERT INTO Product  VALUES (NULL, ?, ?, ?, ?, ?)";
        $params = array(
            $product->color,
            $product->size,
            $product->stock,
            $product->imageRoute,
            $product->productTypeID
        );
        
        try {
            self::select($query, $params);
            return $product;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    

    // Metodo para obtener un producto por su ID de producto
    public static function getProductByID($productID) {
        $query = "SELECT * FROM Product WHERE productID = ?";
        $params = array($productID);
        
        try {
            $result = self::select($query, $params);
            return self::buildProductModel($result[0]);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Metodo para actualizar el stock de un producto en la base de datos
    public static function updateProductStock($productID, $newStock) {
        $query = "UPDATE Product SET stock = ? WHERE productID = ?";
        $params = array($newStock, $productID);
        
        try {
            self::select($query, $params);
            return true; // Retorna true si se actualizó correctamente
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Metodo para eliminar un producto de la base de datos por su ID de producto
    public static function deleteProduct($productID) {
        $query = "DELETE FROM Product WHERE productID = ?";
        $params = array($productID);
        
        try {
            self::select($query, $params);
            return true; //si se elimino correctamente
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

}

?>
