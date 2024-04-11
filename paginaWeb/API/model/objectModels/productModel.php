<?php
class Product
{
    private $productID;
    private $color;
    private $size;
    private $stock;
    private $imageRoute;
    private $productTypeID;

    public function __construct($productID, $color, $size, $stock, $imageRoute, $productTypeID)
    {
        $this->productID = $productID;
        $this->color = $color;
        $this->size = $size;
        $this->stock = $stock;
        $this->imageRoute = $imageRoute;
        $this->productType = $productTypeID;
    }

    public function __get($property) {
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