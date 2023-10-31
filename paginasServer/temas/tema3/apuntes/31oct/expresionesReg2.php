<?php
    echo'Numerico (\d)<br>';
    $exp = '/[0-9]/';    
    $exp = '/[\d]/';    
    $frase = 'Hoy es Halloween y es dia 31 de octubre';
    echo $frase;
    $array = array();
    preg_match_all($exp, $frase, $array);
    print_r($array);

    echo'Numerico (\d)<br>';
    $exp = '/[0-9]/';    
    $exp = '/\d{4}/';    
    $frase = 'Hoy es Halloween y es dia 31 de octubre';
    echo $frase;
    $array = array();
    preg_match_all($exp, $frase, $array);
    print_r($array);

    echo '<br> uso de no contiene ';
    $exp = '/mari[^ao]/';
    echo preg_match($exp, 'mario es mi profe favorito');
    echo preg_match($exp, 'maril es mi profe favorito');

    //nov, noviembre, november
    $exp = '/^nov(iembre|ember)?$/';
    echo preg_match($exp, 'novi');
    echo preg_match($exp, 'nov');
    echo preg_match($exp, 'noviembre');
    echo preg_match($exp, 'november');
    echo preg_match($exp, 'anov');
    echo preg_match($exp, 'novemberp');


    $array = ['Lunes', 'Martes', 'Sabado'];
    $esp = '/es$/';
    print_r(preg_grep($exp, $array));

    $array = [1, 'a', 'B', 4];
    $patron = ['/^\d$/', ''];
    $cambio = 'numero';

    print_r(preg_replace($patron, $cambio, $array));

    $frase = 'maria es mi profe favorita';
    $patron = '/a/';
    $cambio = '@';
    print_r(preg_filter($patron, $cambio, $frase));

    $frase = 'Si hay una fecha 01/02/2012 esta bien pero 10/2/2021 mal, 15/12/21 mal';
    //Si el mes tiene solo dig añado 0
    //año tiene 2 dig < 23 añado 20 y si es mayor 19 delante

    function corrige($coincide){
        print_r($coincide);
        if($coincide[1] < 10){
            $coincide[1]= '0' .$coincide[1];
        }
        if($coincide[3] < 10){
            $coincide[3]= '0' .$coincide[1];
        }
        if($coincide[5] <= 23){
            $coincide[5]= '20' .$coincide[5];
        }
        elseif($coincide[5] <= 23 && $coincide[1] < 100){
            $coincide[5]= '19' .$coincide[5];
        }
        return $coincide[1].$coincide[2].$coincide[3].$coincide[4].$coincide[5];
    }

    
    $exp = '/(\d{2})(\/)(\d{1, 2})(\/)(\d{2, 4})/';
    //preg_match_all($exp, $frase, $array);
    //print_r($array);
    preg_replace_callback($exp, 'corrige', $frase);


?>