<?php
class orderDetail
{
    private $detailID;
    private $quantity;
    private $totalPrice;
    private $orderID;
    private $productID;

    public function __construct($detailID, $quantity, $totalPrice, $orderID, $productID)
    {
        $this->detailID = $detailID;
        $this->quantity = $quantity;
        $this->totalPrice = $totalPrice;
        $this->orderID = $orderID;
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