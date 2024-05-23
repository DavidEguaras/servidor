<?php

class PartidosModel
{
    private $id;
    private $jug1;
    private $jug2;
    private $fecha;
    private $resultado;



    public function __construct($id, $jug1, $jug2, $fecha, $resultado)
    {   
        $this->id = $id;
        $this->jug1 = $jug1;
        $this->jug2 = $jug2;
        $this->fecha = $fecha;
        $this->resultado = $resultado;

    }


    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value){
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}