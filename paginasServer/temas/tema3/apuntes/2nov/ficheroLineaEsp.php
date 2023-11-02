<?php

    $tmp = tempnam(".", "tem.txt");

    if(file_exists('ficheroLineas.txt')){
        echo "Existe el archivo";
        if(!$fp = fopen('ficheroLineas.txt', 'a') || !$ft = fopen($tmp, 'w')){
            echo "Ha habido un problema al abrir el fichero";
        } else {
            $texto = "Mi nueva linea\n";
            $contador = 0;
            while($leido = fgets($fp, filesize("ficheroLineas.txt")))
                fputs($ft, $leido, strlen($leido));
                if($contador == 1){
                    fputs($ft, $texto, strlen($texto));
                }
            fclose($fp);
            fclose($ft);
            unlink("ficheroLineas.txt");
            rename($tmp, "ficheroLineas.txt");
        }
    } else {
        echo "No existe el archivo";
    }
?>
?>