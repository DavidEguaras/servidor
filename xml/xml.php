
<?php
echo "<pre>";
if (file_exists('fichero.xml')) {
    $xml = simplexml_load_file('fichero.xml');
 
    // print_r($xml);
    // foreach ($xml as $elemento) {
    //     // print_r($elemento);
    //     echo "\n El coche es de".$elemento ['id'];
    //     echo " la marca: ".$elemento->marca;
        
    //     echo ", y es el modelo: ".$elemento ->modelo;
    //     echo "<br>";
    // }
} else {
    exit('Failed to open fichero.xml.');
}

//NO FUNCIONA
// function leerElemento($elemento) {
//     foreach ($elemento->children() as $a) {
//        echo $a;
//     }
// }
?>
