<?php
    echo 8 <=> 7;
    echo 5&3;
    $a = 10;
    $b = 5;
    $suma = $a + $b;    
    $resta = $a - $b;
    $multiplicacion = $a * $b;
    $division = $a / $b;
    $modulo = $a % $b;

    
    $a = 10;
    $b = 5;
    if ($a == $b) {
        echo "a es igual a b";
    }
    
    if ($a != $b) {
        echo "a no es igual a b";
    }
    
    if ($a > $b) {
        echo "a es mayor que b";
    }
    
    if ($a < $b) {
        echo "a es menor que b";
    }

    $a = true;
    $b = false;
    if ($a && $b) {
    echo "Ambos son verdaderos";
    }

    if ($a || $b) {
        echo "Al menos uno es verdadero";
    }

    if (!$b) {
        echo "b es falso";
    }


    $edad = 18;
    if ($edad >= 18) {
        echo "Eres mayor de edad";
    } else {
        echo "Eres menor de edad";
    }

    $opcion = 2;
    switch ($opcion) {
        case 1:
            echo "Seleccionaste la opción 1";
            break;
        case 2:
            echo "Seleccionaste la opción 2";
            break;
        case 3:
            echo "Seleccionaste la opción 3";
            break;
        default:
            echo "Opción no válida";
            break;
    }

    


    
?>