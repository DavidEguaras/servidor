<?php
    if(count($_FILES) != 0){
        $ficherosSubidos = array();
        
        $ruta = '/var/www/servidor/paginasIndex/temas/tema3/';
        $ruta .= basename($_FILES['fichero']['name']);
        if(move_uploaded_file($_FILES['fichero']['tmp_name'], $ruta))
            echo "Archivo Subido";
        else
            echo "Ha fallado";
    }
?>