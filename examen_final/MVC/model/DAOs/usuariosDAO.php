<?php
require('./core/funciones.php');

class UsuariosDao
{
    
    //funcion login
    public static function login($user, $password){
        $sql = "SELECT * FROM usuarios WHERE nombre = ? AND password = ?";
        $parametros = array($user,$password);
        $result = FactoryBD::realizarConsulta($sql,$parametros);
        if($result->rowCount()==1){
            $usuario = $result->fetchObject();
            $usuario = new User(
                $usuario->id,
                $usuario->user,
                $usuario->password,
                $usuario->perfil
            );
            echo "login realizado correctamente";
            return $usuario;
        } else {
            echo "Login incorrecto";
            return null;
        }
    }
}



