<?php

function enviado(){
    if(isset($_REQUEST['enviar']))
        return true;
    return false;
}

function textVacio($name){
    if(empty($_REQUEST[$name]))
        return true;
    return false;
}

function errores($errores,$name){
    if(isset($errores[$name]))
            echo $errores[$name];
}

function radioVacio($name){
    if(isset($_REQUEST[$name]))
        return false;
    return true;
}

function recuerdaRadio($name, $value){
    if(enviado() && isset($_REQUEST['genero']) && $_REQUEST['genero'] == false){
        echo 'cheked';
    }
    else if(isset($_REQUEST['borrar']))
        echo'';
}

function recuerdaCheck($name,$value){

    if(enviado() && isset($_REQUEST[$name]) && in_array($value,$_REQUEST[$name])){
        echo 'checked';
    }
    else if (isset($_REQUEST['Borrar']))
        echo '';
}

function selectVacio($name){
    if(isset($_REQUEST[$name]) && $_REQUEST[$name] != 0)
        return false;
    return true;
}

function recuerda($name){
    if(enviado() && !empty($_REQUEST[$name])){
        echo $_REQUEST[$name];
    }else if (isset($_REQUEST['borrar']))
        echo '';
    

}

function recuerdaSelect($name, $value){
    if(enviado() && isset($_REQUEST['genero']) && $_REQUEST['genero'] == false){
        echo 'selected';
    }
    else if(isset($_REQUEST['borrar']))
        echo'';
}

function ValidaFormulario(&$errores){
    if(textVacio('nombre'))
        $errores['nombre'] = "Nombre Vacio";
    if(textVacio('apellido'))
        $errores['apellido'] = "Apellido Vacio";
    if(radioVacio['genero'])
        $errores['genero'] = 'Debe seleccionar un genero'; 
    if(radioVacio['aficion'])
        $errores['aficion'] = 'Debe seleccionar al menos'; 
    if(textVacio('fecha_n'))
        $errores['fecha_n'] = "Fecha de nacimiento";
    if(selectVacio('equipos'))
        $errores[''] = "Debe seleccionar un equipo";
}