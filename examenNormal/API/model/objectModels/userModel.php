<?php
class UserModel
{
    private $id;
    private $username;
    private $name;
    private $rol;
    private $password;
    private $email;

    public function __construct($id, $username, $name, $rol, $password, $email)
    {
        $this->id = $id;
        $this->username = $username;
        $this->name = $name;
        $this->rol = $rol;
        $this->password = $password;
        $this->email = $email;
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
