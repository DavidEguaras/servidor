<?php
 
    //primero ver si existe
    //abrimos y lo leemos
    /*
    if(file_exists('fichero.txt')){
        echo "Existe";
        if(!$fp = fopen('fichero.txt','r'))
            echo "Ha habido un problema al abrir el fichero";
        else{
            $leido = fread($fp,filesize('fichero.txt'));
            echo $leido;
            fclose($fp);
        }
    }else{
        echo "No existe";
    }
 
 
    //Escribir el anterior. w
    echo "<h1>Escribir fichero</h1>";
    if(file_exists('fichero.txt')){
        echo "Existe";
        if(!$fp = fopen('fichero.txt','w'))
            echo "Ha habido un problema al abrir el fichero";
        else{
            $texto = "Escribiendo...";
            if(!fwrite($fp,$texto,strlen($texto)))
                echo "Error al escribir";
                fclose($fp);
        }
    }else{
        echo "No existe";
    }*/

    //Escribir fichero en el medio,         ,
    echo "<h1>Escribir fichero en el medio</h1>";
    if(file_exists('fichero.txt')){
        echo "Existe";
        if(!$fp = fopen('fichero.txt','c'))
            echo "Ha habido un problema al abrir el fichero";
        else{
            $texto = "medio";
            fseek($fp, 28);
            if(!fwrite($fp,$texto,strlen($texto)))
                echo "Error al escribir";
            fclose($fp);
        }
    }else{
        echo "No existe";
    }
?>