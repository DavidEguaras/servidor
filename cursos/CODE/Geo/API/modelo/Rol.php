<?php

class Rol{
private $Id;
private $NombreRol;
private $Borrado;


    public function __construct($Id,$NombreRol,$Borrado=0){
        $this->Id = $Id;
        $this->NombreRol = $NombreRol;
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