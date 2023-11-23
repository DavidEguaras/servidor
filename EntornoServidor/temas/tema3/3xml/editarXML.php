<?php

    function cambioDisponible ($id){
        if (file_exists('juegos.xml')){
            $xml = simplexml_load_file('juegos.xml');
            foreach($xml as $juego){
                if($juego[0]['id'] == $id){
                    if ($juego)
                }
            }

        }
    }


?>