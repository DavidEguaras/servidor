<?php
class Order
{
    private $ORDER_ID;
    private $order_date;
    private $direction;
    private $payment;
    private $total;
    private $USER_ID;

    public function __construct($ORDER_ID, $order_date, $direction, $payment, $total, $USER_ID)
    {
        $this->ORDER_ID = $ORDER_ID;
        $this->order_date = $order_date;
        $this->direction = $direction;
        $this->payment = $payment;
        $this->total = $total;
        $this->USER_ID = $USER_ID;
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