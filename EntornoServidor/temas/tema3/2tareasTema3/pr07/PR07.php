
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

function generarNumerosAleatorios($numerosAleatorios, $min, $max, $cantidad, $puedenRepetirse) {
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
}
?>


<?php
    $ip = $_SERVER['REMOTE_ADDR'];

    // Ruta al archivo de texto que contiene el contador de visitas
    $archivo = 'contador.txt';

    // Lee el número actual de visitas desde el archivo
    $visitas = file_get_contents($archivo);

    // Verifica si la IP actual ha visitado antes
    if(strpos($visitas, $ip) === false){
        // Si la IP no está en la lista, incrementa el contador y guarda la IP
        $visitas++;
        file_put_contents($archivo, $visitas . PHP_EOL . $ip, FILE_APPEND);
    }

    // Muestra el número total de visitas y las visitas desde la misma IP
    echo "Número total de visitas: $visitas<br>";
    echo "Visitas desde la misma IP: " . substr_count($visitas, $ip);
?>