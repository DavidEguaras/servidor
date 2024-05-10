<?php

function validaFormulario(&$errores){
    if(textVacio('email')){
        $errores['email'] = "Email vacío";
    }
    if (textVacio('pass')) {
        $errores['pass'] = "Contraseña vacía";
    }
    if (count($errores)==0)
        return true;
    else
        return false;
}

function validaRegistro(&$errores){
    if(textVacio('email')){
        $errores['email'] = "Email vacío";
    }
    if (count($errores)==0)
        return true;
    else
        return false;
}

function textVacio($name){
    if (empty($_REQUEST[$name])) {
        return true;
    } else {
        return false;
    }
}

function errores($errores,$name){
    if(isset ($errores[$name]))
        echo $errores[$name];
}

function validado(){
    if(isset($_SESSION['usuario']))
        return true;
}

function generarToken($length) {
    $str = random_bytes($length);
    $str = base64_encode($str);
    $str = str_replace(["+", "/", "="], "", $str);
    $str = substr($str, 0, $length);
    return $str;
}