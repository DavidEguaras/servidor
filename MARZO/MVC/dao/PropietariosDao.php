<?php
class PropietariosDao
{
    public static function findAll(){
        $sql = "select * from propietarios";
        $parametros = array();
        $result = FactoryBd::realizarConsulta($sql,$parametros);
        $arrayPropietarios = array();
        while ($propietarioStd = $result->fetchObject()) {
            $propietario = new Propietario(
                $propietarioStd->id,
                $propietarioStd->nombre,
                $propietarioStd->direccion,
                $propietarioStd->telefono,
                $propietarioStd->usuario,
                $propietarioStd->contrasena
            );
            array_push($arrayPropietarios, $propietario);
        }
        return $arrayPropietarios;
    }

    public static function findById($id){
        $sql = "select * from propietarios where id  = ?";
        $parametros = array($id);
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        if ($result->rowCount() == 1) {
            $propietarioStd = $result->fetchObject();
            $propietario = new Propietario(
                $propietarioStd->id,
                $propietarioStd->nombre,
                $propietarioStd->direccion,
                $propietarioStd->telefono,
                $propietarioStd->usuario,
                $propietarioStd->contrasena
            );
            return $propietario;
        } else
            return null;
    }

    public static function insert($propietario){
        $sql = "insert into propietarios (nombre,direccion,telefono,usuario,contrasena) values (?,?,?,?,?)";
        $parametros = array(
            $propietario->nombre,
            $propietario->direccion,
            $propietario->telefono,
            $propietario->usuario,
            $propietario->contraseña
        );
        return FactoryBd::realizarConsulta($sql, $parametros);
    }

    public static function delete($id){
        $sql = "delete from propietarios where id = ?";
        $parametros = array($id);
        return FactoryBd::realizarConsulta($sql, $parametros);
    }

    public static function findByName($name){
        $sql = "select * from propietarios where nombre like ?";
        $parametros = array("%".$name."%"); //para buscar por nombre poniendo cualquier cosa delante y detras
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        $arrayPropietarios = array();
        while ($propietarioStd = $result->fetchObject()) {
            $propietario = new Propietario(
                $propietarioStd->id,
                $propietarioStd->nombre,
                $propietarioStd->direccion,
                $propietarioStd->telefono,
                $propietarioStd->usuario,
                $propietarioStd->contrasena
            );
            array_push($arrayPropietarios, $propietario);
        }
        return $arrayPropietarios;
    }

    public static function update($propietario){
        $sql = "update propietarios set nombre = ?, direccion = ?, telefono = ?, usuario = ?, contrasena = ? where id = ?";
        $parametros = array(
            $propietario->nombre,
            $propietario->direccion,
            $propietario->telefono,
            $propietario->usuario,
            $propietario->contraseña,
            $propietario->id
        );
        return FactoryBd::realizarConsulta($sql, $parametros);
    }

    //para validar el login 

    public static function validarPropietario($nombre,$contraseña){
        $sql = "select * from propietarios where usuario = ? and contrasena = ?";
        $parametros = array($nombre,$contraseña);
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        if ($result->rowCount() == 1) {
            $propietarioStd = $result->fetchObject();
            $propietario = new Propietario(
                $propietarioStd->id,
                $propietarioStd->nombre,
                $propietarioStd->direccion,
                $propietarioStd->telefono,
                $propietarioStd->usuario,
                $propietarioStd->contrasena
            );
            return $propietario;
        } else
            return null;
    }
}