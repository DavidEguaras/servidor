<?php
function validarFormulario(&$errores)
{
    if (isset($_REQUEST['nombre'])) {
        comNombre($errores);
    }
    if (isset($_REQUEST['nombre_completo'])) {
        comNombreCompleto($errores);
    }
    if (isset($_REQUEST['email'])) {
        comEmail($errores);
    }
    if (isset($_REQUEST['pass'])) {
        comcontra($errores);
    }
    if (count($errores) == 0) {
        return true;
    } else {
        return false;
    }
}

function comNombre(&$errores) {
    if (empty($_REQUEST['nombre'])) {
        $errores['nombre'] = "El nombre de usuario es obligatorio";
    }
}

function comNombreCompleto(&$errores) {
    if (empty($_REQUEST['nombre_completo'])) {
        $errores['nombre_completo'] = "El nombre completo es obligatorio";
    }
}

function comEmail(&$errores) {
    if (empty($_REQUEST['email'])) {
        $errores['email'] = "El email es obligatorio";
    } elseif (!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = "El formato del email no es válido";
    }
}

function comcontra(&$errores) {
    if (empty($_REQUEST['pass'])) {
        $errores['pass'] = "La contraseña es obligatoria";
    }
}

function validarFomInsertCoche(&$errores){
    if(isset($_REQUEST['marca'])){
        compMarca($errores);
    }
    if(isset($_REQUEST['modelo'])){
        compModelo($errores);
    }
    if(isset($_REQUEST['descripcion'])){
        compDescripcion($errores);
    }
    if(isset($_REQUEST['precio'])){
        compPrecio($errores);
    }
    if (count($errores) == 0) {
        return true;
    } else {
        return false;
    }
}

function compMarca(&$errores) {
    if (empty($_REQUEST['marca'])) {
        $errores['marca'] = "La marca es obligatoria";
    }
}

function compModelo(&$errores) {
    if (empty($_REQUEST['modelo'])) {
        $errores['modelo'] = "El modelo es obligatorio";
    }
}

function compDescripcion(&$errores) {
    if (empty($_REQUEST['descripcion'])) {
        $errores['descripcion'] = "La descripción es obligatoria";
    }
}

function compPrecio(&$errores) {
    if (empty($_REQUEST['precio'])) {
        $errores['precio'] = "El precio es obligatorio";
    }
}
?>
