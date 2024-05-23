<?php

require_once './model/factory.php';
require_once './model/objectModels/cochesModel.php';

class CochesDAO extends Factory
{
    public static function buildCochesModel($cocheData) {
        if ($cocheData) {
            return array(
                'id' => $cocheData['id'],
                'marca' => $cocheData['marca'],
                'modelo' => $cocheData['modelo'],
                'año_fabricacion' => $cocheData['año_fabricacion'],
                'kilometraje' => $cocheData['kilometraje'],
                'precio' => $cocheData['precio'],
                'color' => $cocheData['color'],
                'descripcion' => $cocheData['descripcion']
            );
        } else {
            return null;
        }
    }

    public static function getAllCoches()
    {
        $query = "SELECT * FROM CochesDeSegundaMano";
        
        try {
            $result = self::select($query);
            $coches = array();
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
        $query = "SELECT * FROM CochesDeSegundaMano WHERE 1=1";
        $params = array();

        if (isset($filters['marca'])) {
            $query .= " AND marca LIKE ?";
            $params[] = '%' . $filters['marca'] . '%';
        }
        if (isset($filters['modelo'])) {
            $query .= " AND modelo LIKE ?";
            $params[] = '%' . $filters['modelo'] . '%';
        }
        if (isset($filters['descripcion'])) {
            $query .= " AND descripcion LIKE ?";
            $params[] = '%' . $filters['descripcion'] . '%';
        }

        try {
            $result = self::select($query, $params);
            $coches = array();
            foreach ($result as $cocheData) {
                $coches[] = self::buildCochesModel($cocheData);
            }
            return $coches;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}

?>
