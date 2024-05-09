<?php

class Carrito{
private $Id;
private $IdUsuario;
private $IdProducto;
private $Borrado;
private $Cantidad;


    public function __construct($Id,$IdUsuario,$IdProducto,$Borrado=0,$Cantidad){
        $this->Id = $Id;
        $this->IdUsuario = $IdUsuario;
        $this->IdProducto = $IdProducto;
        $this->Borrado = $Borrado;
        $this->Cantidad = $Cantidad;
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