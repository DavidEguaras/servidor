<?php
class UserModel
{
    private $userID;
    private $userName;
    private $name;
    private $rol;
    private $password;
    private $email;
    private $activo;

    public function __construct($userID, $userName, $name, $rol, $password, $email, $activo)
    {
        $this->userID = $userID;
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