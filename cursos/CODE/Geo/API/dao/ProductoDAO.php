<?php

require("./modelo/Producto.php");
require_once("./dao/factoryBD.php");

class ProductoDAO{


    public static function findAll() {
        $sql = "select * from Producto";
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
        $sql = "select * from Producto where Id  = ?";
        $parametros = array($id);
        $result = FactoryBd::realizaConsulta($sql, $parametros);
        if ($result->rowCount() == 1) {
            $productoStd = $result->fetchAll(PDO::FETCH_ASSOC);
            return $productoStd;
        } else
            return null;
    }
    public static function insert($producto){
        $sql = "insert into Producto (Nombre,Descripcion,Precio,Categoria,RutaImg,CantidadStock,Borrado) values (?,?,?,?,?,?,?)";
        $parametros = array(
            $producto->Nombre,
            $producto->Descripcion,
            $producto->Precio,
            $producto->Categoria,
            $producto->RutaImg,
            $producto->CantidadStock,
            $producto->Borrado
        );
        return FactoryBd::realizaConsulta($sql, $parametros);
    }

    public static function update($producto){
        $sql = "update Producto set Nombre = ?, Descripcion = ?, Precio = ?, Categoria = ?, RutaImg = ? ,CantidadStock = ? , Borrado = ? where Id = ?";
        $parametros = array(
            $producto->Nombre,
            $producto->Descripcion,
            $producto->Precio,
            $producto->Categoria,
            $producto->RutaImg,
            $producto->CantidadStock,
            $producto->Borrado,
            $producto->Id
        );
        return FactoryBd::realizaConsulta($sql, $parametros);
    }
    
    public static function delete($id){
        $sql = "delete from Producto where id = ?";
        $parametros = array($id);
        return FactoryBd::realizaConsulta($sql, $parametros);
    }









}

    


?>