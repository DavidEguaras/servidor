<?php
// Fecha de nacimiento del usuario (en formato Año-Mes-Día)
$fechaNacimiento = "1990-05-15";

// Obtener la fecha actual
$fechaActual = date("Y-m-d");

// Calcular la diferencia en años entre la fecha de nacimiento y la fecha actual
$edad = floor((strtotime($fechaActual) - strtotime($fechaNacimiento)) / (365 * 24 * 60 * 60));

// Mostrar la edad calculada
echo "Edad: " . $edad . " años";
?>
