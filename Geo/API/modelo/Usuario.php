<?php

class Usuario{
private $Id;
private $Nombre;
private $Contraseña;
private $Email;
private $FechaNacimiento;
private $IdRol;
private $Borrado;


    public function __construct($Id,$Nombre,$Contraseña,$Email,$FechaNacimiento,$IdRol,$Borrado=0){
        $this->Id = $Id;
        $this->Nombre = $Nombre;
        $this->Contraseña = $Contraseña;
        $this->Email = $Email;
        $this->FechaNacimiento = $FechaNacimiento;
        $this->IdRol = $IdRol;
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