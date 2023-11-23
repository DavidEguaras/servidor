<?php

function edad($year, $month, $day){
    $fechaNacimiento = mktime(0, 0, 0, $month, $day, $year);
    $fechaNacimientoObj = new DateTime(date("Y-m-d", $fechaNacimiento));
    $fechaActual = new DateTime();
    $edad = $fechaNacimientoObj->diff($fechaActual)->y;
    return $edad;
}

function añadirAlArray2(&$array, $value){
    $ultimo = count($array);
    $array[$ultimo] = $value;
    //print_r($array);
    return $array;
}
?>
