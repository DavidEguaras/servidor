<?php

class DetallePedido{
private $Id;
private $IdPedido;
private $IdProducto;
private $Cantidad;
private $PrecioUnidad;
private $Total;
private $Borrado;


    public function __construct($Id,$IdPedido,$IdProducto,$Cantidad,$PrecioUnidad,$Total,$Borrado=0){
        $this->Id = $Id;
        $this->IdPedido = $IdPedido;
        $this->IdProducto = $IdProducto;
        $this->Cantidad = $Cantidad;
        $this->PrecioUnidad = $PrecioUnidad;
        $this->Total = $Total;
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