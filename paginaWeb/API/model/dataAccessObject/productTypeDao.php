<?php

class ProductTypeDAO extends Factory {
    // Metodo para construir un objeto productTypeModel a partir de los datos obtenidos de la base de datos
    public static function buildProductTypeModel($productTypeData) {
        if ($productTypeData) {
            return array(
                'PT_ID' =>$productTypeData['PT_ID'],
                'category' =>$productTypeData['category'],
                'name' =>$productTypeData['name'],
                'price' =>$productTypeData['price'],
                'brand' =>$productTypeData['brand'],
                'description' =>$productTypeData['description']
            );
        } else {
            return null;
        }
    }

    // Metodo para crear un nuevo tipo de producto en la base de datos
    public static function createProductType($productType) {
        $query = "INSERT INTO PRODUCT_TYPE VALUES (NULL, ?, ?, ?, ?, ?, ?)";
        $params = array(
            $productType->category,
            $productType->name,
            $productType->price,
            $productType->brand,
            $productType->description,
            $productType -> active
        );
        
        try {
            self::select($query, $params);
            return $productType;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Metodo para obtener un tipo de producto por su ID
    public static function getProductTypeByID($PT_ID) {
        $query = "SELECT * FROM PRODUCT_TYPE WHERE PT_ID = ?";
        $params = array($PT_ID);
        
        try {
            $result = self::select($query, $params);
            return self::buildProductTypeModel($result[0]);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }


    public static function getFirstProductForEachType() {
        $query = "SELECT PT.PT_ID, PT.category, PT.name AS product_name, PT.price, PT.brand, PT.description,
                        P.PRODUCT_ID, P.color, P.size, P.image_route
                  FROM PRODUCT_TYPE PT
                  JOIN (
                      SELECT PT_ID, MIN(PRODUCT_ID) AS first_product_id
                      FROM PRODUCT
                      GROUP BY PT_ID
                  ) AS FirstProducts ON PT.PT_ID = FirstProducts.PT_ID
                  JOIN PRODUCT P ON FirstProducts.first_product_id = P.PRODUCT_ID";
    
        try {
            $result = self::select($query);
            $products = array();
            foreach ($result as $productData) {
                $products[] = array(
                    'PT_ID' => $productData['PT_ID'],
                    'PRODUCT_ID' => $productData['PRODUCT_ID'],
                    'category' => $productData['category'],
                    'name' => $productData['product_name'],
                    'price' => $productData['price'],
                    'brand' => $productData['brand'],
                    'description' => $productData['description'],
                    'color' => $productData['color'],
                    'size' => $productData['size'],
                    'image_route' => $productData['image_route']
                );
            }
            return $products;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    


    // Metodo para actualizar la información de un tipo de producto en la base de datos
    public static function updateProductType($productType) {
        $query = "UPDATE PRODUCT_TYPE SET category = ?, name = ?, price = ?, brand = ?, description = ? WHERE PT_ID = ?";
        $params = array(
            $productType->category,
            $productType->name,
            $productType->price,
            $productType->brand,
            $productType->description,
            $productType->PT_ID
        );
        
        try {
            self::select($query, $params);
            return true; // Retorna true si se actualizó correctamente
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Metodo para eliminar un tipo de producto de la base de datos por su ID
    public static function deleteProductType($PT_ID) {
        $query = "DELETE FROM PRODUCT_TYPE WHERE PT_ID = ?";
        $params = array($PT_ID);
        
        try {
            self::select($query, $params);
            return true; // Retorna true si se eliminó correctamente
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getAllProductTypes() {
        $query = "SELECT * FROM PRODUCT_TYPE";
        
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

    // Metodo para buscar tipos de productos por categoría
    public static function getProductTypesByCategory($category) {
        $query = "SELECT * FROM PRODUCT_TYPE WHERE category = ?";
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

    // Metodo para buscar tipos de productos por marca
    public static function getProductTypesByBrand($brand) {
        $query = "SELECT * FROM PRODUCT_TYPE WHERE brand = ?";
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

    // Metodo para obtener la cantidad de productos por tipo
    public static function getProductCountByType($PT_ID) {
        $query = "SELECT COUNT(*) AS productCount FROM Product WHERE PT_ID = ?";
        $params = array($PT_ID);
        
        try {
            $result = self::select($query, $params);
            return $result[0]['productCount']; // Retorna la cantidad de productos del tipo especificado
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}

?>
