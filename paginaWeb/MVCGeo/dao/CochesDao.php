<?
class CochesDao
{

    public static function findAll(){
        $sql = "select * from coches";
        $parametros = array();
        $result = FactoryBd::realizarConsulta($sql,$parametros);
        $arrayCoches = array();
        while ($cocheStd = $result->fetchObject()) {
            $coche = new Coche(
                $cocheStd->id,
                $cocheStd->marca,
                $cocheStd->modelo,
                $cocheStd->año, // Cambio aquí de $cocheStd->anio a $cocheStd->año tiene que coicidi con el nombre de la columna en la base de datos
                $cocheStd->color,
                $cocheStd->precio,
                $cocheStd->propietario_id
            );
            array_push($arrayCoches, $coche);
        }
        return $arrayCoches;
    }

    public static function getById($id){
        $sql = "select * from coches where id = ?";
        $parametros = array($id);
        $result = FactoryBd::realizarConsulta($sql,$parametros);
        $cocheStd = $result->fetchObject();
        $coche = new Coche(
            $cocheStd->id,
            $cocheStd->marca,
            $cocheStd->modelo,
            $cocheStd->año, // Cambio aquí de $cocheStd->anio a $cocheStd->año
            $cocheStd->color,
            $cocheStd->precio,
            $cocheStd->propietario_id
        );
        return $coche;
    }
    


    // no se le pasa id porque es autoincremental,
    //IMPORTANTE RECORDAR  ORDEN DE LOS PARAMETROS DEBE SER EL MISMO QUE EL DE LA CONSULTA
    //EN LA SENTENCIA LOS NOMBRES IGUAL QUE LA TABLA NO EL OBJETO 
    public static function insert($coche){
        $sql = "insert into coches (marca,modelo,año,color,precio,propietario_id) values (?,?,?,?,?,?)";
        $parametros = array($coche->marca,
        $coche->modelo,
        $coche->anio,
        $coche->color,
        $coche->precio,
        $coche->propietario_id);
        $result = FactoryBd::realizarConsulta($sql,$parametros);
        if($result){
            return true;
        }
        return false;
    }

 
    // public static function delete($usuario)
    // {
    //     $sql = "update Usuario set activo = false where id_usuario=?";
    //     $parametros = array($usuario->id_usuario);
    //     // array_pop($parametros);
    //     // unset($parametros['User perfil']);
    //     $result = FactoryBd::realizarConsulta($sql, $parametros);
    //     if ($result->rowCount() > 0)
    //         return true;

    // }

    public static function delete($id){
        $sql = "delete from coches where id = ?";
        $parametros = array($id);
        $result = FactoryBd::realizarConsulta($sql,$parametros);
        if($result){
            return true;
        }
        return false;
    }
    
    public static function update($coche){
        $sql = "update coches set marca=?,modelo=?,año=?,color=?,precio=?,propietario_id=? where id=?";
        $parametros = array($coche->marca,
        $coche->modelo,
        $coche->anio,
        $coche->color,
        $coche->precio,
        $coche->propietario_id,
        $coche->id);
        $result = FactoryBd::realizarConsulta($sql,$parametros);
        if($result){
            return true;
        }
        return false;
    }

    public static function getByPropietario($idPropietario){
        $sql = "select * from coches where propietario_id = ?";
        $parametros = array($idPropietario);
        $result = FactoryBd::realizarConsulta($sql,$parametros);
        $arrayCoches = array();
        while ($cocheStd = $result->fetchObject()) {
            $coche = new Coche(
                $cocheStd->id,
                $cocheStd->marca,
                $cocheStd->modelo,
                $cocheStd->año, // Cambio aquí de $cocheStd->anio a $cocheStd->año
                $cocheStd->color,
                $cocheStd->precio,
                $cocheStd->propietario_id
            );
            array_push($arrayCoches, $coche);
        }
        return $arrayCoches;
    }

}