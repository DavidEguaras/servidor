<?php

class productTypeModel
{
    private $PT_ID;
    private $category;
    private $name;
    private $price;
    private $brand;
    private $description;
    private $active;


    public function __construct($PT_ID, $category, $name, $price, $brand, $description, $active = 1){
        $this->PT_ID = $PT_ID;
        $this->category = $category;
        $this->name = $name;
        $this->price = $price;
        $this->brand = $brand;
        $this->description = $description;
        $this->active = $active;
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