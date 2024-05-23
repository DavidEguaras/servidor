<?php
class Usuario
{
    public $id;
    public $username;
    public $name;
    public $rol;
    public $password;
    public $email;

    public function __construct($id, $username, $name, $rol, $password, $email)
    {
        $this->id = $id;
        $this->username = $username;
        $this->name = $name;
        $this->rol = $rol;
        $this->password = $password;
        $this->email = $email;
    }
}
?>
