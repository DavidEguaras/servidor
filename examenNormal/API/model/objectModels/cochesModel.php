<?php
class CocheModel
{
    private $id;
    private $modelo;
    private $marca;
    private $descripcion;
    private $precio;

    public function __construct($id, $modelo, $marca, $descripcion, $precio)
    {
        $this->id = $id;
        $this->modelo = $modelo;
        $this->marca = $marca;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
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
