<?

require ('./modelo/Coche.php');
require ('./dao/FactoryBD.php');

class CocheDAO{
    public static function findAllCoches(){
            $sql = "select * from CochesDeSegundaMano";
            $parametros = array();
            $result = FactoryBD::realizaConsulta($sql,$parametros);
    
            $array_coches = array();
            while ($cocheStd = $result->fetchObject()) {
                $coche = new Coche(
                    $cocheStd->id,
                    $cocheStd->marca,
                    $cocheStd->modelo,
                    $cocheStd->año_fabricacion,
                    $cocheStd->kilometraje,
                    $cocheStd->precio,
                    $cocheStd->color,
                    $cocheStd->descripcion
                );
                array_push($array_coches,$coche);
            }
    
            //return array con todos los User
            return $array_coches;
    }

    public static function filtrarCoches($filtro) {
        $sql = "select * from CochesDeSegundaMano where marca like ? or modelo like ? or descripcion like ?";
        $filtro = '%'.$filtro.'%';
        $parametros = array($filtro,$filtro,$filtro);
        $result = FactoryBD::realizaConsulta($sql,$parametros);
    
        $array_coches = array();
        while ($cocheStd = $result->fetchObject()) {
            $coche = new Coche(
                $cocheStd->id,
                $cocheStd->marca,
                $cocheStd->modelo,
                $cocheStd->año_fabricacion,
                $cocheStd->kilometraje,
                $cocheStd->precio,
                $cocheStd->color,
                $cocheStd->descripcion
            );
            array_push($array_coches,$coche);
        }

        //return array con todos los User
        return $array_coches;
    }


}