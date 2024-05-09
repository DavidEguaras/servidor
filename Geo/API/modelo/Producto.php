<?php

class Producto{
private $Id;
private $Nombre;
private $Descripcion;
private $Precio;
private $Categoria;
private $RutaImg;
private $CantidadStock;
private $Borrado;


    public function __construct($Id,$Nombre,$Descripcion,$Precio,$Categoria,$RutaImg,$CantidadStock,$Borrado=0){
        $this->Id = $Id;
        $this->Nombre = $Nombre;
        $this->Descripcion = $Descripcion;
        $this->Precio = $Precio;
        $this->Categoria = $Categoria;
        $this->RutaImg = $RutaImg;
        $this->CantidadStock = $CantidadStock;
        $this->Borrado = $Borrado;
    }

    function __get($att){
        if(property_exists(__CLASS__,$att)){
            return $this->$att;
        }
    }

    function __set($att,$value){
        if(property_exists(__CLASS__,$att)){
            $this->$att = $value;
        }else{
            echo "No existe el atributo";
        }
    }
}

?>