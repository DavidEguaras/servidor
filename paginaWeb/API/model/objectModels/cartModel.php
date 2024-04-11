<?php
class Cart
{
    private $cartID;
    private $lastUpdate;
    private $quantity;
    private $userID;
    private $productID;

    public function __construct($cartID, $lastUpdate, $userID, $productID)
    {
        $this->cartID = $cartID;
        $this->lastUpdate = $lastUpdate;
        $this->userID = $userID;
        $this->productID = $productID;
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