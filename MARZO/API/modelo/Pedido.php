<?php

class Pedido{
private $Id;
private $Fecha;
private $Direccion;
private $PagoTotal;
private $Borrado;


    public function __construct($Id,$Fecha,$Direccion,$PagoTotal,$Borrado=0){
        $this->Id = $Id;
        $this->Fecha = $Fecha;
        $this->Direccion = $Direccion;
        $this->PagoTotal = $PagoTotal;
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