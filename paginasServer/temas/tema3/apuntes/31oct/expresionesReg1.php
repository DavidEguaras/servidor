<?php
    $exp = '/david/';
    echo preg_match($exp, 'david esta intentando entender expresiones regulares');


    echo '<br> Uso del comodin ./davi. ';
    $exp = '/davi./';
    echo preg_match($exp, 'david esta intentando entender expresiones regulares');
    echo preg_match($exp, 'davi esta intentando entender expresiones regulares');

    echo '<br> Uso de /daviz o /david';
    $exp = '/davi[zd]';
    echo preg_match($exp, 'daviz es mi profe favorito');
    echo preg_match($exp, 'david es mi profe favorito');


    echo '<br> Uso de espacio[letra]espacio';

    $exp = '/\s[A-Za-z]\s/';
    $frase = 'Hoy es Halloween y salimos a tomar unas cerverzas';
    echo $frase;
    $array = array();
    preg_match_all($exp, $frase, $array);
    print_r($array);


?>