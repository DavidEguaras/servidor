<?php
class Cart
{
    private $CART_ID;
    private $quantity;
    private $USER_ID;
    private $PRODUCT_ID;

    public function __construct($CART_ID, $quantity, $USER_ID, $PRODUCT_ID)
    {   $this->CART_ID = $CART_ID;
        $this->quantity = $quantity;
        $this->USER_ID = $USER_ID;
        $this->PRODUCT_ID = $PRODUCT_ID;
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