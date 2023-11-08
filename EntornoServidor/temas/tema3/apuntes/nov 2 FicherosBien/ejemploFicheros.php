<?
/*
//primero ver si existe
// abrimos y lo leer
echo "<h1>Leer fichero</h1>";
if(file_exists('fichero.txt')){
    echo "Existe";
    if(!$fp=fopen('fichero.txt','r'))
        echo "Ha habido un problema al abrir el fichero";
    else{
        $leido = fread($fp,filesize("fichero.txt"));
        echo $leido;
        fclose($fp);
    }
   

}else{
    echo "No existe";
}

//Escribir el anterior. w
echo "<h1>Escribir fichero con w borra lo anteior</h1>";
if(file_exists('fichero.txt')){
    echo "Existe";
    if(!$fp=fopen('fichero.txt','w'))
        echo "Ha habido un problema al abrir el fichero";
       
    else{
        $texto = "Escribiendo...";
        if(!fwrite($fp,$texto,strlen($texto)))
        echo "Error al escribir";
        fclose($fp);
    }
   

}else{
    echo "No existe";
}

echo "<h1>Escribir fichero con a al final del fichero</h1>";
if(file_exists('fichero.txt')){
    echo "Existe";
    if(!$fp=fopen('fichero.txt','a'))
        echo "Ha habido un problema al abrir el fichero";
       
    else{
        $texto = "Escribiendo...";
        if(!fwrite($fp,$texto,strlen($texto)))
        echo "Error al escribir";
        fclose($fp);
    }
   

}else{
    echo "No existe";
}

echo "<h1>Escribir fichero con a al final del fichero</h1>";
if(file_exists('fichero.txt')){
    echo "Existe";
    if(!$fp=fopen('fichero.txt','c'))
        echo "Ha habido un problema al abrir el fichero";
       
    else{
        $texto = "Usando la c como modo";
        if(!fwrite($fp,$texto,strlen($texto)))
        echo "Error al escribir";
        fclose($fp);
    }
   

}else{
    echo "No existe";
}


echo "<h1>Escribir fichero en el medio</h1>";
if(file_exists('fichero.txt')){
    echo "Existe";
    if(!$fp=fopen('fichero.txt','c'))
        echo "Ha habido un problema al abrir el fichero";       
    else{
        $texto = "medio";
        fseek($fp,28);
        if(!fwrite($fp,$texto,strlen($texto)))
            echo "Error al escribir";
        fclose($fp);
    } 

}else{
    echo "No existe";
}
echo "<h1>Leer un fichero por lineas</h1>";
if(file_exists('ficheroLineas.txt')){
    echo "Existe";
    if(!$fp=fopen('ficheroLineas.txt','r'))
        echo "Ha habido un problema al abrir el fichero";       
    else{        
        while($leido = fgets($fp,filesize("ficheroLineas.txt"))){  
            echo '<br>'.$leido .' fseek'.ftell($fp);      
        }
        fclose($fp);
    }

}else{
    echo "No existe";
}

echo "<h1>Escribir fichero por lineas Al final </h1>";
if(file_exists('ficheroLineas.txt')){
    echo "Existe";
    if(!$fp=fopen('ficheroLineas.txt','a'))
        echo "Ha habido un problema al abrir el fichero";       
    else{  
        $texto = "\nMi nueva linea";      
        if(!fputs($fp,$texto,strlen($texto)))   
            echo "Error al escribir";        
        fclose($fp);
    }

}else{
    echo "No existe";
}
*/

//Cuando queremos modificar un fichero secuencial
// crear un archivo temporal leer y modificar
// borrar el anterior y renombrar el temp con el nombre del anterior

$tmp = tempnam('.',"tem.txt");
if(file_exists('ficheroLineas.txt')){
    echo "Existe";
    if((!$fp=fopen('ficheroLineas.txt','r')) || (!$ft = fopen($tmp,'w')))
        echo "Ha habido un problema al abrir el fichero";       
    else{        
        $texto = "Linea nueva";
        $contador = 1;
        while($leido = fgets($fp,filesize("ficheroLineas.txt"))){  
                 fputs($ft,$leido,strlen($leido));
                 if($contador==1){
                    fputs($ft,$texto,strlen($texto));
                    fputs($ft,"\n",strlen('\n'));
                    $contador++;
                }
        }
        fclose($fp);
        fclose($ft);
        unlink("ficheroLineas.txt");
        rename($tmp,"ficheroLineas.txt");
    }
}else{
    echo "No existe";
}