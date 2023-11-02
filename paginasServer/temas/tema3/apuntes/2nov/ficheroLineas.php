<?php

    echo "<h1>Leer un fichero por lineas</h1>";
    if(file_exists('ficheroLineas.txt')){
        echo "Existe";
        if(!$fp = fopen('ficheroLineas.txt','r')){
            echo "Ha habido un problema al abrir el fichero";
        }
        else{
            while($leido = fgets($fp, filesize("ficheroLineas.txt")))
                echo '<br>' .$leido;
            fclose($fp);
        }
    }else{
        echo "No existe";
    }



    echo "<h1>Escribir un fichero por lineas(al final)</h1>";
    if(file_exists('ficheroLineas.txt')){
        echo "Existe";
        if(!$fp = fopen('ficheroLineas.txt','a'))
            echo "Ha habido un problema al abrir el fichero";
        else{
            $texto = "\nMi nueva linea";
            if(!fputs($fp, $texto, strlen($texto))){
                echo "Error al escribir";
            }
            fclose($fp);
        }
    }else{
        echo "No existe";
    }


    echo "<h1>Escribir un fichero en una linea especifica (la segunda)</h1>";
    if(file_exists('ficheroLineas.txt')){
        echo "Existe";
        if(!$fp = fopen('ficheroLineas.txt','a'))
            echo "Ha habido un problema al abrir el fichero";
        else{
            fclose($fp);
        }
    }else{
        echo "No existe";
    }
?>