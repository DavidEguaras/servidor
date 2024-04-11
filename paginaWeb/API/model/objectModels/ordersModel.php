<?php
class Order
{
    private $orderID;
    private $orderDate;
    private $direction;
    private $payment;
    private $total;
    private $userID;

    public function __construct($orderID, $orderDate, $direction, $payment, $userID)
    {
        $this->orderID = $orderID;
        $this->orderDate = $orderDate;
        $this->direction = $direction;
        $this->payment = $payment;
        $this->userID = $userID;
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