<?php
class orderDetail
{
    private $detailID;
    private $quantity;
    private $totalPrice;
    private $ORDER_ID;
    private $PRODUCT_ID;

    public function __construct($detailID, $quantity, $totalPrice, $ORDER_ID, $PRODUCT_ID)
    {
        $this->detailID = $detailID;
        $this->quantity = $quantity;
        $this->totalPrice = $totalPrice;
        $this->ORDER_ID = $ORDER_ID;
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