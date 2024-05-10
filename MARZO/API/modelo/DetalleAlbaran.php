<?php

class DetalleAlbaran{
private $Id;
private $IdAlbaran;
private $IdProducto;
private $Unidades;
private $Borrado;


    public function __construct($Id,$IdAlbaran,$IdProducto,$Unidades,$Borrado=0){
        $this->Id = $Id;
        $this->IdAlbaran = $IdAlbaran;
        $this->IdProducto = $IdProducto;
        $this->Unidades = $Unidades;
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