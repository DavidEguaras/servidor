<?php

require_once './model/factory.php';
require_once './model/objectModels/Coche.php';

class CochesDAO extends Factory
{
    public static function buildCochesModel($cocheData) {
        if ($cocheData) {
            return array(
                'id' => $cocheData['id'],
                'modelo' => $cocheData['modelo'],
                'marca' => $cocheData['marca'],
                'descripcion' => $cocheData['descripcion'],
                'precio' => $cocheData['precio']
            );
        } else {
            return null;
        }
    }

    public static function getAllCoches()
    {
        $query = "SELECT * FROM coches";
        try {
            $result = self::select($query);
            $coches = [];
            foreach ($result as $cocheData) {
                $coches[] = self::buildCochesModel($cocheData);
            }
            return $coches;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getCochesByFilter($filters)
    {
        $query = "SELECT * FROM coches WHERE 1=1";
        $params = array();

        if (isset($filters['modelo'])) {
            $query .= " AND modelo LIKE ?";
            $params[] = '%' . $filters['modelo'] . '%';
        }
        if (isset($filters['marca'])) {
            $query .= " AND marca LIKE ?";
            $params[] = '%' . $filters['marca'] . '%';
        }
        if (isset($filters['descripcion'])) {
            $query .= " AND descripcion LIKE ?";
            $params[] = '%' . $filters['descripcion'] . '%';
        }

        try {
            $result = self::select($query, $params);
            $coches = [];
            foreach ($result as $cocheData) {
                $coches[] = self::buildCochesModel($cocheData);
            }
            return $coches;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function createCoche(Coche $coche)
    {
        $query = "INSERT INTO coches (modelo, marca, descripcion, precio) VALUES (?, ?, ?, ?)";
        $params = array(
            $coche->modelo,
            $coche->marca,
            $coche->descripcion,
            $coche->precio
        );

        try {
            self::insert($query, $params);
            return true;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}
?>
