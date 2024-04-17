<?php

class ProductDAO extends Factory {
    // Método para construir un objeto Product a partir de los datos obtenidos de la base de datos
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

    // Método para crear un nuevo producto en la base de datos
    public static function createProduct(Product $product) {
        $query = "INSERT INTO Product (productID, color, size, stock, imageRoute, productTypeID) VALUES (?, ?, ?, ?, ?, ?)";
        $params = array(
            $product->productID,
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

    // Método para obtener un producto por su ID de producto
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

    // Método para actualizar el stock de un producto en la base de datos
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

    // Método para eliminar un producto de la base de datos por su ID de producto
    public static function deleteProduct($productID) {
        $query = "DELETE FROM Product WHERE productID = ?";
        $params = array($productID);
        
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
    public static function getProductsByType($productTypeID) {
        $query = "SELECT * FROM Product WHERE productTypeID = ?";
        $params = array($productTypeID);
        
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
    public static function updateProductInfo($productID, $newColor, $newSize, $newStock, $newImageRoute) {
        $query = "UPDATE Product SET color = ?, size = ?, stock = ?, imageRoute = ? WHERE productID = ?";
        $params = array($newColor, $newSize, $newStock, $newImageRoute, $productID);
        
        try {
            self::select($query, $params);
            return true; // Retorna true si se actualizó correctamente
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}

?>
