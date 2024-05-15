<?php
class Cart
{
    private $CART_ID;
    private $last_update;
    private $quantity;
    private $USER_ID;
    private $PRODUCT_ID;

    public function __construct($CART_ID, $last_update, $USER_ID, $PRODUCT_ID)
    {
        $this->CART_ID = $CART_ID;
        $this->last_update = $last_update;
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