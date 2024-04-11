<?php

class productTypeModel
{
    private $ptID;
    private $category;
    private $name;
    private $price;
    private $brand;
    private $description;


    public function __construct($ptID, $category, $name, $price, $brand, $description){
        $this->ptID = $ptID;
        $this->category = $category;
        $this->name = $name;
        $this->price = $price;
        $this->brand = $brand;
        $this->description = $description;
    }

    public function __get($property){
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}

?>