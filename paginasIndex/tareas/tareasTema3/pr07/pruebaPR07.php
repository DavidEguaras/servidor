<?php
    include('./PR07.php');
    // Ejemplo de uso
    $min = 1;
    $max = 100;
    $cantidad = 10;
    $puedenRepetirse = false;

    $numerosAleatorios = generarNumerosAleatorios($min, $max, $cantidad, $puedenRepetirse);

    echo "Números aleatorios generados: ";
    print_r($numerosAleatorios);
?>