<?php


//array numérico

$arrayNum = array(10);
print_r($arrayNum);

echo "<br>";

$array = array("Lunes","Martes","Miércoles");
print_r($array);

echo "<br>";

$array = array("Lunes",2,"Miércoles");
print_r($array); echo "<br>";
var_dump($array);

echo "<br>";
//echo "<pre>";
$arrayCorta = ["Lunes",25];
var_dump($arrayCorta);
//echo "</pre>";


echo "<br>";
$semana = array("Lunes","Martes","Miércoles","Jueves","Viernes");

for ($i=0; $i < count($semana); $i++) { 
    echo "<br>".$semana[$i];
}

//array dinámico
//modificar su tamaño/contenido
$semana[5] = "Sábado";
for ($i=0; $i < count($semana); $i++) { 
    echo "<br>".$semana[$i];
}

$semana[7] = "Fiesta";
for ($i=0; $i < count($semana); $i++) { 
    echo "<br>".$semana[$i];
}
var_dump($semana);

foreach ($semana as $key => $value) {
    echo "<br>".$semana[$key];
    echo "<br>".$value;
}
echo "<br>";
print_r(array_keys($semana));

//arrays asociativos

$notas = array("Smail"=>10,"Mario"=>9,"Manuel"=>"Sobresaliente");
foreach ($notas as $key => $value) {
    echo "<br> La nota de $key(indice) es : $valor(value)";
}

//arrays multiples
$arrayDAW = array("SOS"=>"Sistemas Operativos","SAD"=>"asd");//asociativo clave sea siglas y valor string
$arrayDAM = array("LM"=>"Lenguajes de Marcas","PSP"=>"Prgram Servicios");
$arrayASIR = array("SOR"=>"Sistemas Operativos","RD"=>"Redes");
$ciclos = array("DAM" => $arrayDam,
                "DAW" => array("CLIENTE" => "PHP", "SERVIDOR" => "JS"),
                "ASIR" => array("CLIENTEs" => "PHPs", "SERVIDORs" => "JSs")
                );

echo "<pre>";
print_r($ciclos);
echo "</pre>";

//recorrerlo
foreach ($ciclos as $key => $value) {
    echo "<br>El ciclo $key tiene las asignaturas: ";
    foreach ($value as $siglas => $nombreA) {
        echo "<br>- $siglas : $nombreA";
    }
}

//reset ir primero
echo "<pre>";
reset($ciclos);
while (current($ciclos)) {
    //print_r(current($ciclos));
    echo "<br>El ciclo ".$key." tiene las asignaturas : ";
    $ciclo = current($ciclos);
    while (current($ciclo)) {
        echo "<br>-" .key($ciclo). ":" .current($ciclo);
        next($ciclo);
    }
    next($ciclos);
}
echo "</pre>";


