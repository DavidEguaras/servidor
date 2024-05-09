<?php

require("./modelo/Usuario.php");
require_once("./dao/factoryBD.php");

class UserDAO{


   



    //devolver array asociativo
    public static function validarUser($nombre, $contraseña) {
        // $contraseña = sha1($contraseña);
        $sql = "SELECT * FROM Usuario WHERE Nombre = ? AND Contraseña = ?";
        $parametros = array($nombre, $contraseña);
        $result = FactoryBd::realizaConsulta($sql, $parametros);
    
        if ($result->rowCount() == 1) {
            $usuarioStd = $result->fetch(PDO::FETCH_ASSOC); 
            return $usuarioStd; 
        } else {
            return null; 
        }
    }
    public static function findById($id){
        $sql = "select * from   Usuario where Id  = ?";
        $parametros = array($id);
        $result = FactoryBd::realizaConsulta($sql, $parametros);
        if ($result->rowCount() == 1) {
            $usuarioStd = $result->fetchAll(PDO::FETCH_ASSOC);
            return $usuarioStd;
        } else
            return null;
    }

    public static function insert($usuario){
        $sql = "INSERT INTO Usuario (Nombre, Contraseña, Email, FechaNacimiento, IdRol, Borrado) VALUES (?, ?, ?, ?, ?, ?)";
        $parametros = array(
            $usuario->Nombre,
            sha1($usuario->Contraseña),
            $usuario->Email,
            $usuario->FechaNacimiento,
            $usuario->IdRol,
            $usuario->Borrado
        );
        
        return FactoryBd::realizaConsulta($sql, $parametros);
    }
    



    public static function update($usuario){
        $sql = "update Usuario set Nombre = ?, Contraseña = ?, Email = ?, FechaNacimiento = ?, IdRol = ? , Borrado = ? where Id = ?";
        $parametros = array(
            $usuario->Nombre,
            $usuario->Contraseña,
            $usuario->Email,
            $usuario->FechaNacimiento,
            $usuario->IdRol,
            $usuario->Borrado,
            $usuario->Id
        );
        return FactoryBd::realizaConsulta($sql, $parametros);
    }
    

    public static function delete($id){
        $sql = "delete from Usuario where Id = ?";
        $parametros = array($id);
        return FactoryBd::realizaConsulta($sql, $parametros);
    }








}

    


?>