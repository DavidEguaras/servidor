<?php

function enviado(){
    if (isset($_REQUEST['Enviar'])) {
        return true;
    }
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

function recuerda($name){
    if(enviado() && !empty($_REQUEST[$name])){
        echo $_REQUEST[$name];
    }
    if (isset($_REQUEST['Borrar'])) {
        echo "''";
    }
}

?>