<?php

require_once './model/factory.php';
require_once './model/objectModels/PartidosModel.php';

class PartidosDao extends Factory 
{
    public static function buildPartidosModel($partidoData)
    {
        if($partidoData)
        {
            return array(
                'id' => $partidoData['id'],
                'jug1' => $partidoData['jug1'],
                'jug2' => $partidoData['jug2'],
                'fecha' => $partidoData['fecha'],
                'resultado' => $partidoData['resultado']
            );

        }else{
            return null;
        }
    }

    public static function getAllPartidos()
    {
        $query = "SELECT * FROM partido";

        try{
            $result = self::select($query);
            $partidos = array();
            foreach($result as $partidoData)
            {
                $partidos[] = self::buildPartidosModel($partidoData); 
            }
            return $partidos;
        }catch(PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getPartidoByID($partido_id)
    {   
        $query = "SELECT * FROM partido WHERE id = ?";
        $params = array($partido_id);

        try 
        {
            $result = self::select($query, $params);
            return self::buildPartidosModel($result);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }

    }

    public static function getPartidoByUserID($user_id)
    {
        $query = "SELECT * FROM partido WHERE jug1 = ? OR jug2 = ?";
        $params = array($user_id);

        try 
        {
            $result = self::select($query, $params);
            return self::buildPartidosModel($result);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }

    }

    
    public static function updatePartido($partido_id, $jug1, $jug2, $fecha, $resultado)
    {
        $query = "UPDATE partido SET jug1 = ?, jug2 = ?, fecha = ?, resultado = ? WHERE id = ?";
        $params = array($jug1, $jug2, $fecha, $resultado, $partido_id);


        try
        {
            self::execute($query, $params);
            return true;
        }catch (PDOException $e) {
            throw new Exception($e->getMessage());

        }
    }   


    public static function createPartido(PartidosModel $partido)
    {
        $query = "INSERT INTO partido (jug1, jug2, fecha, resultado) VALUES (?, ?, ?, ?)";
        $params = array($partido->jug1, $partido->jug2, $partido->fecha, $partido->resultado);

        try
        {
            self::execute($query, $params);
            return true;
        }catch (PDOException $e) {
            throw new Exception($e->getMessage());

        }
    }


    public static function deletePartido($partido_id)
    {

        $query = "DELETE FROM partido WHERE id = ?";
        $params = array($partido_id);

        try
        {
            self::execute($query, $params);
            return true;
        }catch (PDOException $e) {
            throw new Exception($e->getMessage())
            ;
        }
    }


}
