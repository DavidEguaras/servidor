
<?php
//PR07
function br() {
    echo "<br>";
}

function h1($cadena) {
    echo "<h1>$cadena</h1>";
}

function p($cadena) {
    echo "<p>$cadena</p>";
}

function self() {
    return __FILE__;
}

function letraDni($dniSinLetra) {
    $letras = array("TRWAGMYFPDXBNJZSQVHLCKE");
    $letra = $letras[($dni % 23)];
    return $letra;
}

function generarNumerosAleatorios($min, $max, $cantidad, $puedenRepetirse) {
    $numerosAleatorios = [];
    if($puedenRepetirse){
        for($i = 0; $i < $cantidad; $i++){
            $numerosAleatorios[] = rand($min, $max);
        }
    }else{
        //creamos este array para controlar los numeros Utilizados
        $disponibles = range($min, $max);
        for($i = 0; $i < $cantidad; $i++){
            $numeroGenerado = array_rand($disponibles);
            //eliminar del array el numero utilizado en la iteracion actual para evitar su repeticion
            unset($disponibles[$numeroGenerado]);
            //agregamos el numero de esta iteracion al array de numerosAleatorios
            array_push($numerosAleatorios, $numeroGenerado);
        }
    }
    return $numerosAleatorios;
}
?>



<?php
    
?>