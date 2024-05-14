<?php

class ProductTypeDAO extends Factory {
    // Método para construir un objeto productTypeModel a partir de los datos obtenidos de la base de datos
    public static function buildProductTypeModel($productTypeData) {
        if ($productTypeData) {
            return new productTypeModel(
                $productTypeData['ptID'],
                $productTypeData['category'],
                $productTypeData['name'],
                $productTypeData['price'],
                $productTypeData['brand'],
                $productTypeData['description']
            );
        } else {
            return null;
        }
    }

    // Método para crear un nuevo tipo de producto en la base de datos
    public static function createProductType($productType) {
        $query = "INSERT INTO ProductType VALUES (NULL, ?, ?, ?, ?, ?)";
        $params = array(
            $productType->category,
            $productType->name,
            $productType->price,
            $productType->brand,
            $productType->description
        );
        
        try {
            self::select($query, $params);
            return $productType;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Método para obtener un tipo de producto por su ID
    public static function getProductTypeByID($ptID) {
        $query = "SELECT * FROM ProductType WHERE ptID = ?";
        $params = array($ptID);
        
        try {
            $result = self::select($query, $params);
            return self::buildProductTypeModel($result[0]);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Método para actualizar la información de un tipo de producto en la base de datos
    public static function updateProductType($productType) {
        $query = "UPDATE ProductType SET category = ?, name = ?, price = ?, brand = ?, description = ? WHERE ptID = ?";
        $params = array(
            $productType->category,
            $productType->name,
            $productType->price,
            $productType->brand,
            $productType->description,
            $productType->ptID
        );
        
        try {
            self::select($query, $params);
            return true; // Retorna true si se actualizó correctamente
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Método para eliminar un tipo de producto de la base de datos por su ID
    public static function deleteProductType($ptID) {
        $query = "DELETE FROM ProductType WHERE ptID = ?";
        $params = array($ptID);
        
        try {
            self::select($query, $params);
            return true; // Retorna true si se eliminó correctamente
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getAllProductTypes() {
        $query = "SELECT * FROM ProductType";
        
        try {
            $result = self::select($query);
            $productTypes = array();
            foreach ($result as $productTypeData) {
                $productTypes[] = self::buildProductTypeModel($productTypeData);
            }
            return $productTypes; // Retorna todos los tipos de productos
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Método para buscar tipos de productos por categoría
    public static function getProductTypesByCategory($category) {
        $query = "SELECT * FROM ProductType WHERE category = ?";
        $params = array($category);
        
        try {
            $result = self::select($query, $params);
            $productTypes = array();
            foreach ($result as $productTypeData) {
                $productTypes[] = self::buildProductTypeModel($productTypeData);
            }
            return $productTypes; // Retorna los tipos de productos de la categoría especificada
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Método para buscar tipos de productos por marca
    public static function getProductTypesByBrand($brand) {
        $query = "SELECT * FROM ProductType WHERE brand = ?";
        $params = array($brand);
        
        try {
            $result = self::select($query, $params);
            $productTypes = array();
            foreach ($result as $productTypeData) {
                $productTypes[] = self::buildProductTypeModel($productTypeData);
            }
            return $productTypes; // Retorna los tipos de productos de la marca especificada
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Método para obtener la cantidad de productos por tipo
    public static function getProductCountByType($ptID) {
        $query = "SELECT COUNT(*) AS productCount FROM Product WHERE productTypeID = ?";
        $params = array($ptID);
        
        try {
            $result = self::select($query, $params);
            return $result[0]['productCount']; // Retorna la cantidad de productos del tipo especificado
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}

?>
