<?php
class Product
{
    private $PRODUCT_ID;
    private $color;
    private $size;
    private $stock;
    private $imageRoute;
    private $PT_ID;

    public function __construct($PRODUCT_ID, $color, $size, $stock, $imageRoute, $PT_ID)
    {
        $this->PRODUCT_ID = $PRODUCT_ID;
        $this->color = $color;
        $this->size = $size;
        $this->stock = $stock;
        $this->imageRoute = $imageRoute;
        $this->productType = $PT_ID;
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