<?php

class UserModel
{
    private $id;
    private $user;
    private $token;
    private $caduca;

    public function __construct($id, $user, $token, $caduca)
    {
        $this->id = $id;
        $this->user = $user;
        $this->token = $token;
        $this->caduca = $caduca;
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}

?>
