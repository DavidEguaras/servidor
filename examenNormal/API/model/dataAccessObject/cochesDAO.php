<?php

require_once './model/factory.php';
require_once './model/objectModels/cochesModel.php';

class CochesDAO extends Factory
{
    public static function getAllCoches()
    {
        $query = "SELECT * FROM coches";
        try {
            $result = self::select($query);
            return $result;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getCochesByFilter($filters)
    {
        $query = "SELECT * FROM coches WHERE ";
        $conditions = [];
        $params = [];

        if (isset($filters['modelo'])) {
            $conditions[] = "modelo = ?";
            $params[] = $filters['modelo'];
        }
        if (isset($filters['marca'])) {
            $conditions[] = "marca = ?";
            $params[] = $filters['marca'];
        }
        if (isset($filters['descripcion'])) {
            $conditions[] = "descripcion LIKE ?";
            $params[] = "%" . $filters['descripcion'] . "%";
        }

        $query .= implode(' AND ', $conditions);

        try {
            $result = self::select($query, $params);
            return $result;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function createCoche(CocheModel $coche)
    {
        $query = "INSERT INTO coches (modelo, marca, descripcion, precio) VALUES (?, ?, ?, ?)";
        $params = [
            $coche->modelo,
            $coche->marca,
            $coche->descripcion,
            $coche->precio
        ];

        try {
            self::insert($query, $params);
            return true;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}
?>
