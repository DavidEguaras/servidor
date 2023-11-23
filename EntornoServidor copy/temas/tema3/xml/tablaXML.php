<!DOCTYPE html>
<html lang="en">
<style>
table, th, td {
  border:1px solid black;
}
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    
</body>
</html>
<?php
echo "<pre>";
if (file_exists('juegos.xml')) {
    $xml = simplexml_load_file('juegos.xml');

    //============================TABLA PARA MOSTRAR JUEGOS.XML ============================
    echo "<table>";
    echo '<th>Nombre del Juego</th>';
    echo '<th>Dispositivos</th>';
    //detecta los elementos del xml, en este caso estamos tratando con
    foreach ($xml as $juego){
        echo '<tr>';
        echo '<td>' . $juego->nombre .'</td>';
        echo '<td>';

        //Dispositivos es un array y se puede tratar como tal
        foreach ($juego->dispositivos->dispositivo as $dispositivo){
            echo $dispositivo;
            echo '<br>';
        }
        echo '</td>';
        echo '</tr>';
    }
    echo "</table>";
    //============================TABLA PARA MOSTRAR JUEGOS.XML ============================
 
} else {
    exit('Failed to open juegos.xml.');
}
?>
