<?php
    $altura = 5;
    $espacios = $altura - 1;
    $asteriscos = 1;

    // Bucle de piramide
    for ($i = 0; $i < $altura; $i++) {
        for ($j = 0; $j < $espacios; $j++) {
            echo "&nbsp";
            echo "&nbsp";
        }
        for ($a = 0; $a < $asteriscos; $a++) {
            echo "*";
        }
        echo "<br>";
        $espacios--;
        $asteriscos += 2;
    }

    
?>
