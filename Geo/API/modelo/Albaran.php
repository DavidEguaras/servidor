<?php

class Albaran{
private $Id;
private $Fecha;
private $IdUsuario;
private $Borrado;


    public function __construct($Id,$Fecha,$IdUsuario,$Borrado=0){
        $this->Id = $Id;
        $this->Fecha = $Fecha;
        $this->IdUsuario = $IdUsuario;
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