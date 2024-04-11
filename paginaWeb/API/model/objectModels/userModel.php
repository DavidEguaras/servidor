<?php
class UserModel
{
    private $id;
    private $userName;
    private $name;
    private $rol;
    private $password;
    private $email;
    private $activo;

    public function __construct($userName, $name, $rol, $password, $email, $activo)
    {
        $this->userName = $userName;
        $this->name = $name;
        $this->rol = $rol;
        $this->password = $password;
        $this->email = $email;
        $this->activo = $activo;
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