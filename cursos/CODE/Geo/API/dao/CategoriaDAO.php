<?php

require("./modelo/Categoria.php");
require_once("./dao/factoryBD.php");

class CategoriaDAO{


    public static function findAll() {
        $sql = "select * from Categoria";
        $parametros = array();
        $result = FactoryBd::realizaConsulta($sql,$parametros);
        if ($result->rowCount() > 0) {
            $usuarioStd = $result->fetchAll(PDO::FETCH_ASSOC); 
            return $usuarioStd; 
        } else {
            return null; 
        }
    }
    public static function findById($id){
        $sql = "select * from Categoria where Id  = ?";
        $parametros = array($id);
        $result = FactoryBd::realizaConsulta($sql, $parametros);
        if ($result->rowCount() == 1) {
            $productoStd = $result->fetchAll(PDO::FETCH_ASSOC);
            return $productoStd;
        } else
            return null;
    }
    
    public static function findByNombre($nombre){
        $sql = "SELECT * FROM Categoria WHERE Nombre LIKE ?";
        $parametros = array("%$nombre%");
        $result = FactoryBd::realizaConsulta($sql, $parametros);
        if ($result->rowCount() > 0) {
            $productos = $result->fetchAll(PDO::FETCH_ASSOC);
            return $productos;
        } else {
            return null;
        }
    }
    public static function insert($producto){
        $sql = "insert into Categoria (Nombre,Borrado) values (?,?)";
        $parametros = array(
            $producto->Nombre,
            $producto->Borrado
        );
        return FactoryBd::realizaConsulta($sql, $parametros);
    }


    
    public static function delete($id){
        $sql = "delete from Categoria where id = ?";
        $parametros = array($id);
        return FactoryBd::realizaConsulta($sql, $parametros);
    }
}