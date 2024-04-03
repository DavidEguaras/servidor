<?php

class Matricula{
    private $id;
    private $coche_id;
    private $matricula;

    public function __construct($id,$coche_id,$matricula){
        $this->id = $id;
        $this->coche_id = $coche_id;
        $this->matricula = $matricula;
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

