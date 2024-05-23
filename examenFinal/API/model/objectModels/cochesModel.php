<?php

class CochesModel
{
    private $id;
    private $marca;
    private $modelo;
    private $anio_fabricacion;
    private $kilometraje;
    private $precio;
    private $color;
    private $descripcion;

    public function __construct($id, $marca, $modelo, $anio_fabricacion, $kilometraje, $precio, $color, $descripcion)
    {
        $this->id = $id;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->año_fabricacion = $anio_fabricacion;
        $this->kilometraje = $kilometraje;
        $this->precio = $precio;
        $this->color = $color;
        $this->descripcion = $descripcion;
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}

?>
