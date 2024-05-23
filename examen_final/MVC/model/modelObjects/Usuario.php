<?php

class User{
    private $id;
    private $nombre;
    private $password;
    private $perfil;


    function __construct($id,$nombre,$password,$perfil){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->password = $password;
        $this->perfil = $perfil;
    }

    public function __get($att){
        if (property_exists(__CLASS__, $att)) {
            return $this->$att;
        }
    }
    public function __set($att, $val){
        if (property_exists(__CLASS__, $att)) {
            $this->$att = $val;
        }
 
    }

}